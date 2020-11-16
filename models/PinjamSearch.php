<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pinjam;


/**
 * PinjamSearch represents the model behind the search form of `app\models\Pinjam`.
 */
class PinjamSearch extends Pinjam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_pinjam', 'id_anggota', 'tenor', 'tgl_pinjam', 'cicilan', 'bayar_cicilan', 'id_karyawan'], 'safe'],
            [['jml_pinjam'], 'integer'],
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
        $query = Pinjam::find();

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

        if (($this->tgl_pinjam)=="ID1") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '1']);
        }
        elseif (($this->tgl_pinjam)=="ID2") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '2']);
        }
        elseif (($this->tgl_pinjam)=="ID3") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '3']);
        }
        elseif (($this->tgl_pinjam)=="ID4") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '4']);
        }
        elseif (($this->tgl_pinjam)=="ID5") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '5']);
        }
        elseif (($this->tgl_pinjam)=="ID6") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '6']);
        }
        elseif (($this->tgl_pinjam)=="ID7") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '7']);
        }
        elseif (($this->tgl_pinjam)=="ID8") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '8']);
        }
        elseif (($this->tgl_pinjam)=="ID9") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '9']);
        }
        elseif (($this->tgl_pinjam)=="ID10") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '10']);
        }
        elseif (($this->tgl_pinjam)=="ID11") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '11']);
        }
        elseif (($this->tgl_pinjam)=="ID12") {
            $query->andFilterWhere(['MONTH(tgl_pinjam)' => '12']);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'jml_pinjam' => $this->jml_pinjam,
            'cicilan' => $this->jml_pinjam,
            //'bayar_cicilan' => $this->jml_pinjam,
            //'tgl_pinjam' => $this->tgl_pinjam,
        ]);

        $query->andFilterWhere(['like', 'no_pinjam', $this->no_pinjam])
            //->andFilterWhere(['like', 'id_anggota', $this->id_anggota])
            ->andFilterWhere(['like', 'tenor', $this->tenor])
            ->andFilterWhere(['like', 'id_karyawan', $this->id_karyawan]);

        if(Yii::$app->user->identity->roletype=='Anggota') {
            $query->andFilterWhere(['id_anggota' => Yii::$app->user->identity->username,]);
        }
        else {
            $query->andFilterWhere(['like', 'id_anggota', $this->id_anggota]);
        }

        /*if(Yii::$app->user->identity->roletype=='Karyawan') {
            $query->andFilterWhere(['id_karyawan' => Yii::$app->user->identity->username,]);
        } */

        return $dataProvider;
    }
}
