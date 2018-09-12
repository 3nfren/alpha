<?php

use yii\db\Migration;

/**
 * Class m180815_221727_active_proy_bitacora
 */
class m180815_221727_active_proy_bitacora extends Migration
{
    public function safeUp() // FUNCION PARA CREAR LAS TABLAS
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%Proyectos}}',[
        'idProyecto'=>$this->primaryKey(),
        'NombreProyecto'=>$this->string(200)->unique(),
        'Activo'=>$this->boolean()
        ],$tableOptions);

    $this->createTable('{{Actividades}}',[
            'idActividad'=>$this->primaryKey(),
            'NombreActividad'=>$this->string(200)->unique(),
            'Activo'=>$this->boolean(),
            'idProyecto'=>$this->integer()
                    ],$tableOptions);

    $this->createTable('{{%Bitacoratiempos}}',[
            'idBitacoraTiempo'=>$this->primaryKey(),
            'Fecha'=>$this->date(),
            'HoraInicio'=>$this->time(),
            'HoraFinal'=>$this->time(),
            'Interrupcion'=>$this->time(),
            'Total'=>$this->float(),
            'ActividadNoPlaneada'=>$this->string(250),
            'idActividadePlaneada'=>$this->integer(),
            'idProyecto'=>$this->integer(),
            'Artefacto'=>$this->string(250),
            'idUsuario'=>$this->integer()
                    ],$tableOptions);

    $this->addForeignKey('FK_act_proy','Actividades','idProyecto','Proyectos','idProyecto');
    $this->addForeignKey('FK_bitt_proy','Bitacoratiempos','idProyecto','Proyectos','idProyecto');
    }

    public function safeDown() // FUNCION PARA ELIMINAR LAS TABLAS
    {
        $this->dropForeignKey('FK_act_proy','Actividades');
        $this->dropForeignKey('FK_bitt_proy','Bitacoratiempos');
        $this->dropTable('{{%Proyectos}}');
        $this->dropTable('{{%Actividades}}');
        $this->dropTable('{{%Bitacoratiempos}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180815_221727_active_proy_bitacora cannot be reverted.\n";

        return false;
    }
    */
}
