<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "actividades".
 *
 * @property int $idActividad
 * @property string $NombreActividad
 * @property int $Activo
 * @property int $idProyecto
 *
 * @property Proyectos $proyecto
 */
class Actividades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actividades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Activo', 'idProyecto'], 'integer'],
            [['NombreActividad'], 'string', 'max' => 200],
            [['NombreActividad'], 'unique'],
            [['idProyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyectos::className(), 'targetAttribute' => ['idProyecto' => 'idProyecto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idActividad' => Yii::t('app', 'Id Actividad'),
            'NombreActividad' => Yii::t('app', 'Nombre Actividad'),
            'Activo' => Yii::t('app', 'Activo'),
            'idProyecto' => Yii::t('app', 'Id Proyecto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyecto()
    {
        return $this->hasOne(Proyectos::className(), ['idProyecto' => 'idProyecto']);
    }

    public function beforeSave($insert){
        parent::beforeSave($insert);
        if($insert)
            $this->Activo = 1;
        return true;
    }
}
