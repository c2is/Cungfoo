./vendor/bin/propel-gen app/config/Propel main
mysql -uroot cungfoo < app/resources/data/sql/Cungfoo.Model.schema.sql
./console fixtures:load