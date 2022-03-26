<template>
  <div class="mt-2">
    <div class="text-center">
      <p>年齢: </p>
    </div>
    <hr />
    <h4>マニュアル</h4>
    <div class="col-12">
      <label class="col-4 col-form-label">タイトル:</label>
      <div class="col-10 col-lg-3">
        <input type="data" class="form-control" />
      </div>
      <label class="col-6 col-form-label">新規マニュアル:</label>
      <div class="col-10 col-lg-5 mb-3">
        <textarea class="form-control"> </textarea>
      </div>
      <button class="btn btn-primary">登録</button>
    </div>

    <hr />

    <div class="mb-4">
      <label lass="col-2 col-form-label">タイトル更新:</label>
      <div class="col-10 col-lg-3">
        <input type="datal" class="form-control" />
      </div>
      <label lass="col-2 col-form-label">マニュアル更新:</label>
      <div class="col-10 col-lg-5">
        <textarea class="form-control"> </textarea>
      </div>
    </div>

    <hr />

    <h5>マニュアル一覧</h5>
    <div class="col-6 col-lg-3 mb-3">
      <input
        type="text"
        class="form-control"
      />
    </div>

    <div class="scroll">
      <div>
        <!-- titleの値は予測変換位でないが、検索はできる -->
        <p>タイトル: </p>
        <p class="space"></p>
        <button
          class="btn btn-primary px-0 col-2 col-lg-1"
        >
          更新
        </button>
        <button
          class="btn btn-primary px-0 col-2 col-lg-1 mx-2"
        >
          削除
        </button>
        <hr />
      </div>
    </div>

    <div class="text-center mt-1">
      <p>ページ</p>
      <div class="container">
        <nav>
          <ul class="pagination" style="justify-content: center">
            <li class="page-item">
              <a class="page-link">&laquo;</a>
            </li>
            <li class="page-item">
              <a class="page-link">&lt;</a>
            </li>

            <li v-for="i in displayPageRange" :key="i" class="page-item">
              <a class="page-link">{{ i }}</a>
            </li>

            <li class="page-item">
              <a class="page-link">&gt;</a>
            </li>
            <li class="page-item">
              <a class="page-link">&raquo;</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>
<script>
     export default {
         props: {
             id: Number
         }
     }
 </script>