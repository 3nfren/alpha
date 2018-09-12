<?php

namespace backend\models;

use Yii;



/**
 * This is the model class for table "bitacoratiempos".
 *
 * @property int $idBitacoraTiempo
 * @property string $Fecha
 * @property string $HoraInicio
 * @property string $HoraFinal
 * @property string $Interrupcion
 * @property double $Total
 * @property string $ActividadNoPlaneada
 * @property int $idActividadePlaneada
 * @property int $idProyecto
 * @property string $Artefacto
 * @property int $idUsuario
 *
 * @property Proyectos $proyecto
 */
class Bitacoratiempos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bitacoratiempos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Fecha', 'HoraInicio', 'HoraFinal', 'Interrupcion'], 'safe'],
            //['Fecha','date'],
            ['Interrupcion','match','pattern'=> '/[0-9][0-9]:[0-5][0-9]/','message'=>'indique en formato hh:mm'],
            //[['Total'], 'number'],
            [['idActividadePlaneada', 'idProyecto', 'idUsuario'], 'integer'],
            [['ActividadNoPlaneada', 'Artefacto'], 'string', 'max' => 250],
             [['Fecha', 'HoraInicio', 'HoraFinal', 'Interrupcion','Artefacto'], 'required','message'=>'campo requerido']
            //[['idProyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyectos::className(), 'targetAttribute' => ['idProyecto' => 'idProyecto']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idBitacoraTiempo' => Yii::t('app', 'Id Bitacora Tiempo'),
            'Fecha' => Yii::t('app', 'Fecha'),
            'HoraInicio' => Yii::t('app', 'Hora Inicio'),
            'HoraFinal' => Yii::t('app', 'Hora Final'),
            'Interrupcion' => Yii::t('app', 'Interrupcion'),
            'Total' => Yii::t('app', 'Total'),
            'ActividadNoPlaneada' => Yii::t('app', 'Actividad No Planeada'),
            'idActividadePlaneada' => Yii::t('app', 'Id Actividade Planeada'),
            'idProyecto' => Yii::t('app', 'Id Proyecto'),
            'Artefacto' => Yii::t('app', 'Artefacto'),
            'idUsuario' => Yii::t('app', 'Id Usuario'),
        ];
    }

    public function beforeSave($insert) {
        $fechaHoraInicio = date_create_from_format('h:i a', $this->HoraInicio);
        $fechaHoraFinal = date_create_from_format('h:i a', $this->HoraFinal);
        $fechaHoraInt = date_create_from_format('H:i', $this->Interrupcion);
        $interval = date_diff($fechaHoraFinal, $fechaHoraInicio);
        $this->Total = (($interval->h * 60 + $interval->i) - (
                $fechaHoraInt->format('i'))) / 60.0;
        $this->Fecha = date_format(date_create_from_format('d-m-Y', $this->Fecha), 'Y-m-d');
        $this->HoraInicio = date_format($fechaHoraInicio, 'Y-m-d H:i:s');
        $this->HoraFinal = date_format($fechaHoraFinal, 'Y-m-d H:i:s');
        $this->Interrupcion = date_format($fechaHoraInt, 'Y-m-d H:i:s');
        $this->idUsuario = Yii::$app->user->id;
        return true;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyecto()
    {
        return $this->hasOne(Proyectos::className(), ['idProyecto' => 'idProyecto']);
    }


    public function guardaRegistro($inputFile){
        try{
            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPEXCEL_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);

            $sheet =  $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            for($row = 1; $row <= $highestRow; $row++){
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL,TRUE,FALSE);
                if($row == 1){
                    continue;
                }

                $registro = new Bitacoratiempos();
                $registro->Fecha = $rowData[0][0];
                $registro->HoraInicio = $rowData[0][1];
                $registro->Interrupcion = $rowData[0][2];
                $registro->HoraFinal = $rowData[0][3];
                $registro->ActividadNoPlaneada = $rowData[0][6];
                $registro->idProyecto  = $rowData[0][7];
                $registro->Artefacto = $rowData[0][8];
                $registro->save();
            }
            return true;
        } catch(yii\db\Exception $e){
            return false;
        }

    }
   public function difTiempos($fechaHoraInicio,$fechaHoraFinal){
        $cadenaSql = "select  *from bitacoratiempos as a where a.HoraInicio >= '" . $fechaHoraInicio . "' and a.HoraFinal <= '" . $fechaHoraFinal ."'";
        

        $rows = $this->getDb()->createCommand($cadenaSql)->queryAll();
  
        return $rows;
    }
}
