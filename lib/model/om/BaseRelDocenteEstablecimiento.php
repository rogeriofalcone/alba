<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'model/RelDocenteEstablecimientoPeer.php';

/**
 * Base class that represents a row from the 'rel_docente_establecimiento' table.
 *
 * 
 *
 * @package model.om
 */
abstract class BaseRelDocenteEstablecimiento extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var RelDocenteEstablecimientoPeer
	 */
	protected static $peer;


	/**
	 * The value for the fk_establecimiento_id field.
	 * @var int
	 */
	protected $fk_establecimiento_id = 0;


	/**
	 * The value for the fk_docente_id field.
	 * @var int
	 */
	protected $fk_docente_id = 0;

	/**
	 * @var Docente
	 */
	protected $aDocente;

	/**
	 * @var Establecimiento
	 */
	protected $aEstablecimiento;

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
	 * Get the [fk_establecimiento_id] column value.
	 * 
	 * @return int
	 */
	public function getFkEstablecimientoId()
	{

		return $this->fk_establecimiento_id;
	}

	/**
	 * Get the [fk_docente_id] column value.
	 * 
	 * @return int
	 */
	public function getFkDocenteId()
	{

		return $this->fk_docente_id;
	}

	/**
	 * Set the value of [fk_establecimiento_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setFkEstablecimientoId($v)
	{

		if ($this->fk_establecimiento_id !== $v || $v === 0) {
			$this->fk_establecimiento_id = $v;
			$this->modifiedColumns[] = RelDocenteEstablecimientoPeer::FK_ESTABLECIMIENTO_ID;
		}

		if ($this->aEstablecimiento !== null && $this->aEstablecimiento->getId() !== $v) {
			$this->aEstablecimiento = null;
		}

	} // setFkEstablecimientoId()

	/**
	 * Set the value of [fk_docente_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setFkDocenteId($v)
	{

		if ($this->fk_docente_id !== $v || $v === 0) {
			$this->fk_docente_id = $v;
			$this->modifiedColumns[] = RelDocenteEstablecimientoPeer::FK_DOCENTE_ID;
		}

		if ($this->aDocente !== null && $this->aDocente->getId() !== $v) {
			$this->aDocente = null;
		}

	} // setFkDocenteId()

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

			$this->fk_establecimiento_id = $rs->getInt($startcol + 0);

			$this->fk_docente_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 2; // 2 = RelDocenteEstablecimientoPeer::NUM_COLUMNS - RelDocenteEstablecimientoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RelDocenteEstablecimiento object", $e);
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
			$con = Propel::getConnection(RelDocenteEstablecimientoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RelDocenteEstablecimientoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RelDocenteEstablecimientoPeer::DATABASE_NAME);
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

			if ($this->aDocente !== null) {
				if ($this->aDocente->isModified()) {
					$affectedRows += $this->aDocente->save($con);
				}
				$this->setDocente($this->aDocente);
			}

			if ($this->aEstablecimiento !== null) {
				if ($this->aEstablecimiento->isModified()) {
					$affectedRows += $this->aEstablecimiento->save($con);
				}
				$this->setEstablecimiento($this->aEstablecimiento);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RelDocenteEstablecimientoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RelDocenteEstablecimientoPeer::doUpdate($this, $con);
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

			if ($this->aDocente !== null) {
				if (!$this->aDocente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDocente->getValidationFailures());
				}
			}

			if ($this->aEstablecimiento !== null) {
				if (!$this->aEstablecimiento->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEstablecimiento->getValidationFailures());
				}
			}


			if (($retval = RelDocenteEstablecimientoPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RelDocenteEstablecimientoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getFkEstablecimientoId();
				break;
			case 1:
				return $this->getFkDocenteId();
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
		$keys = RelDocenteEstablecimientoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getFkEstablecimientoId(),
			$keys[1] => $this->getFkDocenteId(),
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
		$pos = RelDocenteEstablecimientoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setFkEstablecimientoId($value);
				break;
			case 1:
				$this->setFkDocenteId($value);
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
		$keys = RelDocenteEstablecimientoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setFkEstablecimientoId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFkDocenteId($arr[$keys[1]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RelDocenteEstablecimientoPeer::DATABASE_NAME);

		if ($this->isColumnModified(RelDocenteEstablecimientoPeer::FK_ESTABLECIMIENTO_ID)) $criteria->add(RelDocenteEstablecimientoPeer::FK_ESTABLECIMIENTO_ID, $this->fk_establecimiento_id);
		if ($this->isColumnModified(RelDocenteEstablecimientoPeer::FK_DOCENTE_ID)) $criteria->add(RelDocenteEstablecimientoPeer::FK_DOCENTE_ID, $this->fk_docente_id);

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
		$criteria = new Criteria(RelDocenteEstablecimientoPeer::DATABASE_NAME);


		return $criteria;
	}

	/**
	 * Returns NULL since this table doesn't have a primary key.
	 * This method exists only for BC and is deprecated!
	 * @return null
	 */
	public function getPrimaryKey()
	{
		return null;
	}

	/**
	 * Dummy primary key setter.
	 *
	 * This function only exists to preserve backwards compatibility.  It is no longer
	 * needed or required by the Persistent interface.  It will be removed in next BC-breaking
	 * release of Propel.
	 *
	 * @deprecated
	 */
	 public function setPrimaryKey($pk)
	 {
		 // do nothing, because this object doesn't have any primary keys
	 }

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param object $copyObj An object of RelDocenteEstablecimiento (or compatible) type.
	 * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setFkEstablecimientoId($this->fk_establecimiento_id);

		$copyObj->setFkDocenteId($this->fk_docente_id);


		$copyObj->setNew(true);

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
	 * @return RelDocenteEstablecimiento Clone of current object.
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
	 * @return RelDocenteEstablecimientoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RelDocenteEstablecimientoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Docente object.
	 *
	 * @param Docente $v
	 * @return void
	 * @throws PropelException
	 */
	public function setDocente($v)
	{


		if ($v === null) {
			$this->setFkDocenteId('0');
		} else {
			$this->setFkDocenteId($v->getId());
		}


		$this->aDocente = $v;
	}


	/**
	 * Get the associated Docente object
	 *
	 * @param Connection Optional Connection object.
	 * @return Docente The associated Docente object.
	 * @throws PropelException
	 */
	public function getDocente($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseDocentePeer.php';

		if ($this->aDocente === null && ($this->fk_docente_id !== null)) {

			$this->aDocente = DocentePeer::retrieveByPK($this->fk_docente_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = DocentePeer::retrieveByPK($this->fk_docente_id, $con);
			   $obj->addDocentes($this);
			 */
		}
		return $this->aDocente;
	}

	/**
	 * Declares an association between this object and a Establecimiento object.
	 *
	 * @param Establecimiento $v
	 * @return void
	 * @throws PropelException
	 */
	public function setEstablecimiento($v)
	{


		if ($v === null) {
			$this->setFkEstablecimientoId('0');
		} else {
			$this->setFkEstablecimientoId($v->getId());
		}


		$this->aEstablecimiento = $v;
	}


	/**
	 * Get the associated Establecimiento object
	 *
	 * @param Connection Optional Connection object.
	 * @return Establecimiento The associated Establecimiento object.
	 * @throws PropelException
	 */
	public function getEstablecimiento($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseEstablecimientoPeer.php';

		if ($this->aEstablecimiento === null && ($this->fk_establecimiento_id !== null)) {

			$this->aEstablecimiento = EstablecimientoPeer::retrieveByPK($this->fk_establecimiento_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = EstablecimientoPeer::retrieveByPK($this->fk_establecimiento_id, $con);
			   $obj->addEstablecimientos($this);
			 */
		}
		return $this->aEstablecimiento;
	}

} // BaseRelDocenteEstablecimiento