./console cache:clear
./vendor/bin/propel-gen app/config/Propel main
mysql -uroot cungfoo < app/resources/data/sql/Cungfoo.Model.schema.sql
./console fixtures:load
./console cache:clear
./console vacancesdirectes:database:check-integrity
git checkout src/Cungfoo/Model
git checkout src/Cungfoo/Listing
git checkout src/Cungfoo/Form
git checkout app/
