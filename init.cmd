./console cache:clear
./vendor/bin/propel-gen app/config/Propel main
mysql -uroot cungfoo < app/resources/data/sql/Cungfoo.Model.schema.sql
./console fixtures:load
./console cache:clear
git checkout src/Cungfoo/Model src/Cungfoo/Listing src/Cungfoo/Form
