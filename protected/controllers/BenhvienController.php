<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class BenhvienController extends CController {

    const ADD_SUCCESS = 'Thêm bệnh viện thành công';
    const EDIT_SUCCESS_ALERT = 'Cập nhật bệnh viện thành công';
    const DELETE_SUCCESS_ALERT = 'Xóa bệnh viện thành công';

    public $modelName = 'Benhvien';

    /**
     * Index action is the default action in a controller.
     */
    public $code = 200;
    public $message = "";
    public $data = array();
    public $response = array();

    function _response() {
        $this->response['code'] = $this->code;
        $this->response['message'] = $this->message;
        if (!empty($this->data)) {
            $this->response['data'] = $this->data;
        }

        header('Content-Type: application/json');
        echo json_encode($this->response);
        Yii::app()->end();
    }

    function renderJson($code, $message, $data = array()) {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;

        $this->_response();
    }

    public function actionIndex() {
        $this->render('show');
    }

    public function actionBenhvien() {

        $bv = Benhvien::model()->findAll();
        foreach ($bv as $item) {
            $data[] = array(
                'id' => $item->id,
                'ten' => $item->ten,
                'diachi' => $item->diachi,
                'gioithieu' => $item->gioithieu
            );
        }

        $this->renderJson(200, "Thành công", $data);
    }

    public function actionSearch() {
        $search = $_GET["search"];
        $cond = new CDbCriteria();

        $cond->addSearchCondition('ten', $search);

        $data = Benhvien::model()->findAll($cond);
        $count = Benhvien::model()->count($cond);
        $this->render('results', array(
            'data' => $data,
            'count' => $count,
            'search' => $search,
        ));
    }

    public function actionAdd() {
        $bv = new Benhvien();
        if ($_POST) {
            $bv->attributes = $_POST;
            if ($bv->validate()) {
                $bv->save();
                $this->renderJson(200, "Thêm Bệnh viện thành công");
            } else {
                $this->renderJson(500, "Lỗi", $bv->getErrors());
            }
        } else {
            $this->renderJson(200, "Không có dữ liệu");
        }
    }

    public function actionGetId($id) {
        $bv = new Benhvien();
        $bv = Benhvien::model()->findByPk($id);
        if ($bv) {
            $data[] = array(
                'id' => $bv->id,
                'ten' => $bv->ten,
                'diachi' => $bv->diachi,
                'gioithieu' => $bv->gioithieu
            );
            $this->renderJson(200, "Thành công", $data);
        } else {
            $this->renderJson(500, "Lỗi");
        }
    }

    public function actionUpdate() {
        $id = filter_input(INPUT_POST, 'id');
        $bv = Benhvien::model()->findByPk($id);
        if ($bv) {
            $bv->attributes = $_POST;
            if ($bv->validate()) {
                $bv->save();
                $this->renderJson(200, "Cập nhật Bệnh viện thành công");
            } else {
                $this->renderJson(500, "Lỗi", $bv->getErrors());
            }
        } else {
            $this->renderJson(200, "Không có dữ liệu");
        }
    }

    public function actionDelete() {
        $id = filter_input(INPUT_POST, 'id');
        $bv = Benhvien::model()->findByPk($id);
        $bv->delete();
        $this->renderJson(200, "Xóa Bệnh viện thành công");
    }

}
