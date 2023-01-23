<?php

namespace app\controllers;

use app\models\Studenten;
use app\models\StudentenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;




/**
 * StudentenController implements the CRUD actions for Studenten model.
 */
class StudentenController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Studenten models.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        $searchModel = new StudentenSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        //hier ↓ haal ik informatie uit mijn database. bij aantal_minuten_te_laat word er avg,sum en max gebruikt daarmee bereken je de Hoogste aantal minuten,Gemiddeld aantal minuten en Totaal aantal minuten. 
        $sql="SELECT AVG(aantal_minuten_te_laat) as  gemiddelde, SUM(aantal_minuten_te_laat) as totaal, MAX(aantal_minuten_te_laat) as hoogste FROM studenten";
        $result = Yii::$app->db->createCommand($sql)->queryOne();


        $hoogste=$result['hoogste']; //hier krijgt $hoogste de waarde $result['hoogste'] en als je nu echo $hoogste gebruikt in views/studenten/index.php dan zie je het hoogste aantal minuten te laat van aantal_minuten_te_laat.
        $gemiddelde=$result['gemiddelde'];//hier krijgt $gemiddelde de waarde $result['gemiddelde'] en als je nu echo $gemiddelde gebruikt in views/studenten/index.php dan zie je de gemiddelde aantal minuten van aantal_minuten_te_laat.
        $totaal=$result['totaal'];//hier krijgt $totaal de waarde $result['totaal'] en als je nu echo $totaal gebruikt in views/studenten/index.php dan zie je het totaal aantal minuten van aantal_minuten_te_laat.
        return $this->render('index', [
            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'hoogste' => $hoogste, //hier heb ik hoogste een variabele gegeven zodat ik later $hoogste een waarde kan geven en de rest van de opdracht kan afmaken 
            'gemiddelde' => $gemiddelde,//hier heb ik gemiddelde een variabele gegeven zodat ik later $gemiddelde een waarde kan geven en de rest van de opdracht kan afmaken
            'totaal' => $totaal,//hier heb ik totaal een variabele gegeven zodat ik later $totaal een waarde kan geven en de rest van de opdracht kan afmaken
        ]);
        
    }

    /**
     * Displays a single Studenten model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Studenten model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Studenten();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Studenten model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Studenten model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Studenten model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Studenten the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Studenten::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
