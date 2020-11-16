<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ambil;

/**
 * AmbilSearch represents the model behind the search form of `app\models\Ambil`.
 */
class AmbilSearch extends Ambil
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_ambil', 'id_anggota', 'tgl_ambil', 'id_karyawan'], 'safe'],
            [['jml_ambil'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Ambil::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (($this->tgl_ambil)=="ID1") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '1']);
        }
        elseif (($this->tgl_ambil)=="ID2") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '2']);
        }
        elseif (($this->tgl_ambil)=="ID3") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '3']);
        }
        elseif (($this->tgl_ambil)=="ID4") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '4']);
        }
        elseif (($this->tgl_ambil)=="ID5") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '5']);
        }
        elseif (($this->tgl_ambil)=="ID6") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '6']);
        }
        elseif (($this->tgl_ambil)=="ID7") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '7']);
        }
        elseif (($this->tgl_ambil)=="ID8") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '8']);
        }
        elseif (($this->tgl_ambil)=="ID9") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '9']);
        }
        elseif (($this->tgl_ambil)=="ID10") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '10']);
        }
        elseif (($this->tgl_ambil)=="ID11") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '11']);
        }
        elseif (($this->tgl_ambil)=="ID12") {
            $query->andFilterWhere(['MONTH(tgl_ambil)' => '12']);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'jml_ambil' => $this->jml_ambil,
            //'tgl_ambil' => $this->tgl_ambil,
        ]);

        $query->andFilterWhere(['like', 'no_ambil', $this->no_ambil])
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
