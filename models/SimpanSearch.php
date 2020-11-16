<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Simpan;
use app\models\TbMasterData;
use yii\helpers\ArrayHelper;
//use kartik\daterange\DateRangeBehavior;

/**
 * SimpanSearch represents the model behind the search form of `app\models\Simpan`.
 */
class SimpanSearch extends Simpan
{
    // This attribute will hold the values to filter our database data
    //public $created_at_range;
    /**
     * @inheritdoc
     */

    /*public $createTimeRange;
    public $createTimeStart;
    public $createTimeEnd;*/

    //public $tgl_simpan_range;
    public $start_date;
    public $end_date;

    /*public function behaviors()
    {
        return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'createTimeRange',
                'dateStartAttribute' => 'createTimeStart',
                'dateEndAttribute' => 'createTimeEnd',
            ]
        ];
    }*/

    public function rules()
    {
        return [
            [['no_simpan', 'id_anggota', 'tgl_simpan', 'id_karyawan'], 'safe'],
            //[['start_date', 'end_date'], 'safe'],
            [['jml_simpan'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Simpan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }

        //filter id anggota
        /*if ($this->id_anggota) {
            $query->andFilterWhere(['id_anggota' => Yii::$app->user->identity->username]);
        }else {
            $query->andFilterWhere(['like', 'id_anggota', $this->id_anggota]);
        }*/

        //filter tanggal simpan
        if (($this->tgl_simpan)=="ID1") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '1']);
        }
        elseif (($this->tgl_simpan)=="ID2") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '2']);
        }
        elseif (($this->tgl_simpan)=="ID3") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '3']);
        }
        elseif (($this->tgl_simpan)=="ID4") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '4']);
        }
        elseif (($this->tgl_simpan)=="ID5") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '5']);
        }
        elseif (($this->tgl_simpan)=="ID6") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '6']);
        }
        elseif (($this->tgl_simpan)=="ID7") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '7']);
        }
        elseif (($this->tgl_simpan)=="ID8") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '8']);
        }
        elseif (($this->tgl_simpan)=="ID9") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '9']);
        }
        elseif (($this->tgl_simpan)=="ID10") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '10']);
        }
        elseif (($this->tgl_simpan)=="ID11") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '11']);
        }
        elseif (($this->tgl_simpan)=="ID12") {
            $query->andFilterWhere(['MONTH(tgl_simpan)' => '12']);
        }

        //$query->andFilterWhere(['between', 'tgl_simpan', $this->start_date, $this->jml_simpan]);

        // grid filtering conditions
        $query->andFilterWhere([
            'jml_simpan' => $this->jml_simpan,
            //'tgl_simpan' => $this->tgl_simpan,
        ]);

        $query->andFilterWhere(['like', 'no_simpan', $this->no_simpan])
            //->andFilterWhere(['like', 'id_anggota', $this->id_anggota])
            ->andFilterWhere(['like', 'id_karyawan', $this->id_karyawan]);

        if(Yii::$app->user->identity->roletype=='Anggota') {
            $query->andFilterWhere(['id_anggota' => Yii::$app->user->identity->username,]);
        }
        else {
            $query->andFilterWhere(['like', 'id_anggota', $this->id_anggota]);
        }

        /*if(Yii::$app->user->identity->roletype=='Karyawan') {
            $query->andFilterWhere(['id_karyawan' => Yii::$app->user->identity->username,]);
        } 
        else {
            $query->andFilterWhere(['like', 'id_karyawan', $this->id_karyawan]);
        }*/

        return $dataProvider;
    }
}