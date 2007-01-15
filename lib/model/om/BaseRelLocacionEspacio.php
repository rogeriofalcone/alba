<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'model/RelLocacionEspacioPeer.php';

/**
 * Base class that represents a row from the 'rel_locacion_espacio' table.
 *
 * 
 *
 * @package model.om
 */
abstract class BaseRelLocacionEspacio extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var RelLocacionEspacioPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var int
	 */
	protected $id;


	/**
	 * The value for the fk_locacion_id field.
	 * @var int
	 */
	protected $fk_locacion_id;


	/**
	 * The value for the fk_espacio_id field.
	 * @var int
	 */
	protected $fk_espacio_id;

	/**
	 * @var Locacion
	 */
	protected $aLocacion;

	/**
	 * @var Espacio
	 */
	protected $aEspacio;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [id] column value.
	 * 
	 * @return int
	 */
	public function getId()
	{

		return $this->id;
	}

	/**
	 * Get the [fk_locacion_id] column value.
	 * 
	 * @return int
	 */
	public function getFkLocacionId()
	{

		return $this->fk_locacion_id;
	}

	/**
	 * Get the [fk_espacio_id] column value.
	 * 
	 * @return int
	 */
	public function getFkEspacioId()
	{

		return $this->fk_espacio_id;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setId($v)
	{

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = RelLocacionEspacioPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [fk_locacion_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setFkLocacionId($v)
	{

		if ($this->fk_locacion_id !== $v) {
			$this->fk_locacion_id = $v;
			$this->modifiedColumns[] = RelLocacionEspacioPeer::FK_LOCACION_ID;
		}

		if ($this->aLocacion !== null && $this->aLocacion->getId() !== $v) {
			$this->aLocacion = null;
		}

	} // setFkLocacionId()

	/**
	 * Set the value of [fk_espacio_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setFkEspacioId($v)
	{

		if ($this->fk_espacio_id !== $v) {
			$this->fk_espacio_id = $v;
			$this->modifiedColumns[] = RelLocacionEspacioPeer::FK_ESPACIO_ID;
		}

		if ($this->aEspacio !== null && $this->aEspacio->getId() !== $v) {
			$this->aEspacio = null;
		}

	} // setFkEspacioId()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return int next starting column
	 * @throws PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->fk_locacion_id = $rs->getInt($startcol + 1);

			$this->fk_espacio_id = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = RelLocacionEspacioPeer::NUM_COLUMNS - RelLocacionEspacioPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RelLocacionEspacio object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param Connection $con
	 * @return void
	 * @throws PropelException
	 * @see BaseObject::setDeleted()
	 * @see BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RelLocacionEspacioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RelLocacionEspacioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param Connection $con
	 * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws PropelException
	 * @see doSave()
	 */
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RelLocacionEspacioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param Connection $con
	 * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws PropelException
	 * @see save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aLocacion !== null) {
				if ($this->aLocacion->isModified()) {
					$affectedRows += $this->aLocacion->save($con);
				}
				$this->setLocacion($this->aLocacion);
			}

			if ($this->aEspacio !== null) {
				if ($this->aEspacio->isModified()) {
					$affectedRows += $this->aEspacio->save($con);
				}
				$this->setEspacio($this->aEspacio);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RelLocacionEspacioPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += RelLocacionEspacioPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return array ValidationFailed[]
	 * @see validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param mixed $columns Column name or an array of column names.
	 * @return boolean Whether all columns pass validation.
	 * @see doValidate()
	 * @see getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param array $columns Array of column names to validate.
	 * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aLocacion !== null) {
				if (!$this->aLocacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLocacion->getValidationFailures());
				}
			}

			if ($this->aEspacio !== null) {
				if (!$this->aEspacio->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEspacio->getValidationFailures());
				}
			}


			if (($retval = RelLocacionEspacioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param string $name name
	 * @param string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RelLocacionEspacioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param int $pos position in xml schema
	 * @return mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getFkLocacionId();
				break;
			case 2:
				return $this->getFkEspacioId();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RelLocacionEspacioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getFkLocacionId(),
			$keys[2] => $this->getFkEspacioId(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param string $name peer name
	 * @param mixed $value field value
	 * @param string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RelLocacionEspacioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param int $pos position in xml schema
	 * @param mixed $value field value
	 * @return void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setFkLocacionId($value);
				break;
			case 2:
				$this->setFkEspacioId($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param array  $arr     An array to populate the object from.
	 * @param string $keyType The type of keys the array uses.
	 * @return void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RelLocacionEspacioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFkLocacionId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFkEspacioId($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RelLocacionEspacioPeer::DATABASE_NAME);

		if ($this->isColumnModified(RelLocacionEspacioPeer::ID)) $criteria->add(RelLocacionEspacioPeer::ID, $this->id);
		if ($this->isColumnModified(RelLocacionEspacioPeer::FK_LOCACION_ID)) $criteria->add(RelLocacionEspacioPeer::FK_LOCACION_ID, $this->fk_locacion_id);
		if ($this->isColumnModified(RelLocacionEspacioPeer::FK_ESPACIO_ID)) $criteria->add(RelLocacionEspacioPeer::FK_ESPACIO_ID, $this->fk_espacio_id);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RelLocacionEspacioPeer::DATABASE_NAME);

		$criteria->add(RelLocacionEspacioPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param int $key Primary key.
	 * @return void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param object $copyObj An object of RelLocacionEspacio (or compatible) type.
	 * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setFkLocacionId($this->fk_locacion_id);

		$copyObj->setFkEspacioId($this->fk_espacio_id);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a pkey column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return RelLocacionEspacio Clone of current object.
	 * @throws PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return RelLocacionEspacioPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RelLocacionEspacioPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Locacion object.
	 *
	 * @param Locacion $v
	 * @return void
	 * @throws PropelException
	 */
	public function setLocacion($v)
	{


		if ($v === null) {
			$this->setFkLocacionId(NULL);
		} else {
			$this->setFkLocacionId($v->getId());
		}


		$this->aLocacion = $v;
	}


	/**
	 * Get the associated Locacion object
	 *
	 * @param Connection Optional Connection object.
	 * @return Locacion The associated Locacion object.
	 * @throws PropelException
	 */
	public function getLocacion($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseLocacionPeer.php';

		if ($this->aLocacion === null && ($this->fk_locacion_id !== null)) {

			$this->aLocacion = LocacionPeer::retrieveByPK($this->fk_locacion_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = LocacionPeer::retrieveByPK($this->fk_locacion_id, $con);
			   $obj->addLocacions($this);
			 */
		}
		return $this->aLocacion;
	}

	/**
	 * Declares an association between this object and a Espacio object.
	 *
	 * @param Espacio $v
	 * @return void
	 * @throws PropelException
	 */
	public function setEspacio($v)
	{


		if ($v === null) {
			$this->setFkEspacioId(NULL);
		} else {
			$this->setFkEspacioId($v->getId());
		}


		$this->aEspacio = $v;
	}


	/**
	 * Get the associated Espacio object
	 *
	 * @param Connection Optional Connection object.
	 * @return Espacio The associated Espacio object.
	 * @throws PropelException
	 */
	public function getEspacio($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseEspacioPeer.php';

		if ($this->aEspacio === null && ($this->fk_espacio_id !== null)) {

			$this->aEspacio = EspacioPeer::retrieveByPK($this->fk_espacio_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = EspacioPeer::retrieveByPK($this->fk_espacio_id, $con);
			   $obj->addEspacios($this);
			 */
		}
		return $this->aEspacio;
	}

} // BaseRelLocacionEspacio