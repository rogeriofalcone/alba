<?php
		
require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'provincia' table to 'alba' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an 
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive 
 * (i.e. if it's a text column type).
 *
 * @package model.map
 */	
class ProvinciaMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'model.map.ProvinciaMapBuilder';	

    /**
     * The database map.
     */
    private $dbMap;

	/**
     * Tells us if this DatabaseMapBuilder is built so that we
     * don't have to re-build it every time.
     *
     * @return boolean true if this DatabaseMapBuilder is built, false otherwise.
     */
    public function isBuilt()
    {
        return ($this->dbMap !== null);
    }

	/**
     * Gets the databasemap this map builder built.
     *
     * @return the databasemap
     */
    public function getDatabaseMap()
    {
        return $this->dbMap;
    }

    /**
     * The doBuild() method builds the DatabaseMap
     *
	 * @return void
     * @throws PropelException
     */
    public function doBuild()
    {
		$this->dbMap = Propel::getDatabaseMap('alba');
		
		$tMap = $this->dbMap->addTable('provincia');
		$tMap->setPhpName('Provincia');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NOMBRE_CORTO', 'NombreCorto', 'string', CreoleTypes::VARCHAR, true);

		$tMap->addColumn('NOMBRE_LARGO', 'NombreLargo', 'string', CreoleTypes::VARCHAR, true);

		$tMap->addForeignKey('FK_PAIS_ID', 'FkPaisId', 'int', CreoleTypes::INTEGER, 'pais', 'ID', true, null);

		$tMap->addColumn('ORDEN', 'Orden', 'int', CreoleTypes::INTEGER, false);
				
    } // doBuild()

} // ProvinciaMapBuilder