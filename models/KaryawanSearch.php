<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Karyawan;

/**
 * KaryawanSearch represents the model behind the search form of `app\models\Karyawan`.
 */
class KaryawanSearch extends Karyawan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_karyawan', 'nama', 'jekel', 'ttl', 'email', 'no_telp', 'tgl_masuk_kerja'], 'safe'],
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
        $query = Karyawan::find();

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

        if (($this->tgl_masuk_kerja)=="ID1") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '1']);
        }
        elseif (($this->tgl_masuk_kerja)=="ID2") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '2']);
        }
        elseif (($this->tgl_masuk_kerja)=="ID3") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '3']);
        }
        elseif (($this->tgl_masuk_kerja)=="ID4") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '4']);
        }
        elseif (($this->tgl_masuk_kerja)=="ID5") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '5']);
        }
        elseif (($this->tgl_masuk_kerja)=="ID6") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '6']);
        }
        elseif (($this->tgl_masuk_kerja)=="ID7") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '7']);
        }
        elseif (($this->tgl_masuk_kerja)=="ID8") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '8']);
        }
        elseif (($this->tgl_masuk_kerja)=="ID9") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '9']);
        }
        elseif (($this->tgl_masuk_kerja)=="ID10") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '10']);
        }
        elseif (($this->tgl_masuk_kerja)=="ID11") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '11']);
        }
        elseif (($this->tgl_masuk_kerja)=="ID12") {
            $query->andFilterWhere(['MONTH(tgl_masuk_kerja)' => '12']);
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'id_karyawan', $this->id_karyawan])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'jekel', $this->jekel])
            ->andFilterWhere(['like', 'ttl', $this->ttl])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'no_telp', $this->no_telp]);

        return $dataProvider;
    }
}
