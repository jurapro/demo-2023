<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'create'],
                    'rules' => [
                        [
                            'actions' => ['index', 'create'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
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
     * Lists all Cart models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cart::find()->where(['user_id' => \Yii::$app->user->id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cart model.
     * @param int $id ID
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
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id_product)
    {
        $product = Product::find()
            ->where(['id' => $id_product])
            ->andWhere(['>', 'count', 0])
            ->one();

        if (!$product) {
            return "Такого продукта нет";
        }

        $itemInCart = Cart::find()
            ->where(['product_id' => $id_product])
            ->andWhere(['user_id' => Yii::$app->user->getId()])
            ->one();

        if (!$itemInCart) {
            $itemInCart = new Cart([
                'product_id' => $id_product,
                'user_id' => Yii::$app->user->getId(),
                'count' => 1
            ]);
            $itemInCart->save();
            return "Продукт добавлен. Количество товаров в корзине = $itemInCart->count";
        }

        if ($itemInCart->count + 1 > $product->count) {
            return "Нельзя больше добавить";
        }

        $itemInCart->count++;
        $itemInCart->save();
        return "Продукт добавлен. Количество товаров в корзине = $itemInCart->count";
    }

    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
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
     * Deletes an existing Cart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_product)
    {
        $itemInCart = Cart::find()
            ->where(['product_id' => $id_product])
            ->andWhere(['user_id' => Yii::$app->user->getId()])
            ->one();

        if (!$itemInCart) {
            return "Продукт не найден";
        }

        if ($itemInCart->count - 1 == 0) {
            $itemInCart->delete();
            return "Продукт удален";
        }

        $itemInCart->count--;
        $itemInCart->save();
        return "Количество продукта в корзине уменьшено";
    }

    /**
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cart::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
