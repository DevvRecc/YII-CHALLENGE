<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "studenten".
 *
 * @property string $naam_student
 * @property string $klas
 * @property int $aantal_minuten_te_laat
 * @property string $reden_student
 */
class Studenten extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'studenten';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['naam_student', 'klas', 'aantal_minuten_te_laat', 'reden_student'], 'required'],
            [['aantal_minuten_te_laat','id'], 'integer'],
            [['naam_student', 'klas'], 'string', 'max' => 50],
            [['reden_student'], 'string', 'max' => 2000],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'naam_student' => 'Naam Student',
            'klas' => 'Klas',
            'aantal_minuten_te_laat' => 'Aantal Minuten Te Laat',
            'reden_student' => 'Reden Student',
            
        ];
    }
}
