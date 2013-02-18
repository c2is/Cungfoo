<?php

/**
 * @author     Morgan Brunot
 */
class ActiveBehavior extends Behavior
{
    protected $tableModificationOrder = 60;

    // default parameters value
    protected $parameters = array(
        'active_column' => 'active',
        'active_locale_column' => 'active_locale',
    );

    protected $alreadyDeclared = array('I18n');

    protected function isAlreadyDeclared($method)
    {
        if (in_array($method, $this->alreadyDeclared)) {
            return true;
        }

        $this->alreadyDeclared[] = $method;

        return false;
    }

    public function modifyTable()
    {
        if (!$this->getTable()->containsColumn($this->getParameter('active_column')))
        {
            $this->getTable()->addColumn(array(
                'name'    => $this->getParameter('active_column'),
                'type'    => 'BOOLEAN',
                'default' => true,
            ));
        }

        if ($this->getTable()->hasBehavior('i18n')) {
            $this->getTable()->addColumn(array(
                'name'    => $this->getParameter('active_locale_column'),
                'type'    => 'BOOLEAN',
                'default' => true,
            ));

            // add active_locale_column on behavior i18n_columns parameter
            $this->getTable()->getBehavior('i18n')->addParameter(array(
                'name' => 'i18n_columns',
                'value' => $this->getTable()->getBehavior('i18n')->getParameter('i18n_columns').','.$this->getParameter('active_locale_column'),
            ));

            // every behavior adding a table should re-execute database behaviors
            foreach ($this->getTable()->getDatabase()->getBehaviors() as $behavior) {
                $behavior->modifyDatabase();
            }
        }
    }

    protected function getColumnPhpName($column)
    {
        return $this->getColumnForParameter($column)->getPhpName();
    }

    public function objectMethods($builder)
    {
        $script = "";

        $this->addIsActiveMethod($script);

        if ($this->getTable()->hasBehavior('i18n')) {
            $this->addIsActiveLocaleMethod($script);
        }

        foreach ($this->getTable()->getCrossFks() as $fkList) {
            list($refFK, $crossFK) = $fkList;
            $this->addCrossFKGet($script, $refFK, $crossFK);
        }

        foreach ($this->getTable()->getReferrers() as $refFK) {
            if (!$refFK->isLocalPrimaryKey()) {
                $this->addRefFKGet($script, $refFK);
            }
        }

        $this->alreadyDeclared = array();

        return $script;
    }

    public function queryMethods($builder)
    {
        $script = "";

        $this->addFindMethod($script);

        return $script;
    }

    protected function addIsActiveMethod(&$script)
    {
        $script .= "

/**
 * return true is the object is active
 *
 * @return boolean
 */
public function is".$this->getColumnPhpName('active_column')."()
{
    return \$this->get".$this->getColumnPhpName('active_column')."();
}";
    }

    protected function addIsActiveLocaleMethod(&$script)
    {
            $script .= "

/**
 * return true is the object is active locale
 *
 * @return boolean
 */
public function isActiveLocale()
{
    return \$this->getActiveLocale();
}";
    }

    protected function addFindMethod(&$script)
    {
        $tableName = $this->getTable()->getPhpName();

        $script .= "

/**
 * return only active objects
 *
 * @return boolean
 */
public function find".$this->getColumnPhpName('active_column')."(\$con = null)
{
    \$locale = defined('CURRENT_LANGUAGE') ? CURRENT_LANGUAGE : 'fr';

    \$this
        ->filterBy".$this->getColumnPhpName('active_column')."(true)";

        if ($this->getTable()->hasBehavior('i18n')) {
            $script .= "
        ->useI18nQuery(\$locale, 'i18n_locale')
            ->filterByActiveLocale(true)
                ->_or()
            ->filterByActiveLocale(null, Criteria::ISNULL)
        ->endUse()";
        }

        $script .= "
    ;

    return parent::find(\$con);
}";

    }

    protected function addRefFKGet(&$script, ForeignKey $refFK)
    {
        $name = str_replace($this->getTable()->getPhpName(), '', $refFK->getTable()->getPhpName());
        if ($this->isAlreadyDeclared($name)) {
            return;
        }

        $relatedName = $name."s";
        $relatedNameActive = $relatedName."Active";
        $relatedPeerClassName = '\\'.$this->getTable()->getNamespace().'\\'.$name."Peer";

        $peerActiveColumn = strtoupper($this->getParameter('active_column'));

        $relatedPeerI18nClassName = false;
        if ($refFK->getForeignTable()->hasBehavior('i18n')) {
            $relatedPeerI18nClassName = '\\'.$this->getTable()->getNamespace().'\\'.$name."I18nPeer";
            $peerActiveLocaleColumn = strtoupper($this->getParameter('active_locale_column'));
        }

        $script .= "

public function get{$relatedNameActive}(\$criteria = null, PropelPDO \$con = null)
{

    if (\$criteria === null)
    {
        \$criteria = new \Criteria();
    }

    \$criteria->add({$relatedPeerClassName}::{$peerActiveColumn}, true);

";
        if ($relatedPeerI18nClassName) {

            $script .= "
    \$criteria->addAlias('i18n_locale', {$relatedPeerI18nClassName}::TABLE_NAME);
    \$criteria->addJoin({$relatedPeerClassName}::ID, {$relatedPeerI18nClassName}::alias('i18n_locale', {$relatedPeerI18nClassName}::ID), \Criteria::LEFT_JOIN);
    \$criteria->add({$relatedPeerI18nClassName}::alias('i18n_locale', {$relatedPeerI18nClassName}::{$peerActiveLocaleColumn}), true);
    \$criteria->add({$relatedPeerI18nClassName}::alias('i18n_locale', {$relatedPeerI18nClassName}::LOCALE), \$this->currentLocale);
";
        }

        $script .= "
    return \$this->get{$relatedName}(\$criteria, \$con);
}";
    }

    protected function addCrossFKGet(&$script, ForeignKey $refFK, $crossFK)
    {
        if ($this->isAlreadyDeclared($crossFK->getForeignTable()->getPhpName())) {
            return;
        }

        $relatedName = $crossFK->getForeignTable()->getPhpName()."s";
        $relatedNameActive = $relatedName."Active";
        $relatedPeerClassName = '\\'.$this->getTable()->getNamespace().'\\'.$crossFK->getForeignTable()->getPhpName()."Peer";

        $peerActiveColumn = strtoupper($this->getParameter('active_column'));

        $relatedPeerI18nClassName = false;
        if ($crossFK->getForeignTable()->hasBehavior('i18n')) {
            $relatedPeerI18nClassName = '\\'.$this->getTable()->getNamespace().'\\'.$crossFK->getForeignTable()->getPhpName()."I18nPeer";
            $peerActiveLocaleColumn = strtoupper($this->getParameter('active_locale_column'));
        }

        $script .= "

public function get{$relatedNameActive}(\$criteria = null, PropelPDO \$con = null)
{
    if (\$criteria === null)
    {
        \$criteria = new \Criteria();
    }

    \$criteria->add({$relatedPeerClassName}::{$peerActiveColumn}, true);

";
        if ($relatedPeerI18nClassName) {

            $script .= "
    \$criteria->addAlias('i18n_locale', {$relatedPeerI18nClassName}::TABLE_NAME);
    \$criteria->addJoin({$relatedPeerClassName}::ID, {$relatedPeerI18nClassName}::alias('i18n_locale', {$relatedPeerI18nClassName}::ID), \Criteria::LEFT_JOIN);
    \$criteria->add({$relatedPeerI18nClassName}::alias('i18n_locale', {$relatedPeerI18nClassName}::{$peerActiveLocaleColumn}), true);
    \$criteria->add({$relatedPeerI18nClassName}::alias('i18n_locale', {$relatedPeerI18nClassName}::LOCALE), \$this->currentLocale);
";
        }

        $script .= "
    return \$this->get{$relatedName}(\$criteria, \$con);
}";
    }
}
