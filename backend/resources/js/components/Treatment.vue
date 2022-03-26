<template>
  <div
    class="mt-2"
  >
    <div class="text-center">
      <p>年齢: </p>
    </div>
    <hr />
    <h4>処置</h4>
    <div>
      <button class="btn btn-warning m-0 py-0 px-1">
        閉じる
      </button>
      <div>
        <label class="col-form-label col-5 mt-1">新規処置記録追加:</label>
        <div class="col-10 col-lg-6 mb-3">
          <textarea class="form-control"></textarea>
        </div>
        <button class="btn btn-primary">
          追加
        </button>
      </div>

      <hr />

      <div>
        <label class="col-form-label col-5 pt-0">既存処置選択:</label>
        <div class="col-10 col-lg-6 mb-2">
          <select
            class="form-select form-select-sm"
          >
            <option value="">選択してください</option>
            <option>
              処置1
            </option>
          </select>
        </div>

        <label class="col-form-label col-5">選択内容更新:</label>
        <div class="col-10 col-lg-6 mb-2">
          <input
            type="text"
            class="form-control"
          />
        </div>

        <button
          class="btn btn-primary"
        >
          登録
        </button>
        <button
          class="btn btn-primary mx-2"
        >
          選択した処置記録を削除
        </button>
      </div>
    </div>

    <div>
      <button class="btn btn-warning">
        新規処置追加フォーム表示
      </button>
    </div>

    <hr />

    <div>
      <label class="col-4 col-form-label">処置記録登録: </label>
      <div class="col-8 col-lg-3 mb-3">
        <input type="datetime-local" class="form-control" />
      </div>
      <div class="col-10 col-lg-3 mb-3">
        <select class="form-select form-select-sm">
          <option value="">選択してください</option>
          <option
          >
            処置1
          </option>
        </select>
      </div>
      <button class="btn btn-primary">登録</button>
    </div>

    <hr />

    <div>
      <label lass="col-2 col-form-label">各月の処置記録抽出:</label>
      <div class="col-6 my-2">
        <input type="month" class="form-control" />
      </div>
      <button
        class="btn btn-primary px-1"
      >
       月分表示
      </button>
    </div>

    <hr />

    <div>
      <label class="col-6 col-form-label">日付指定処置記録抽出:</label>

      <div class="col-6 mb-2">
        <input type="date" class="form-control" />
        <p class="m-0 p-0">から</p>
        <input type="date" class="form-control" />
      </div>
      <button class="btn btn-primary px-1">
        - 分表示
      </button>
      <button class="btn btn-primary px-1 mx-2">クリア</button>
    </div>
    <hr />

    <label class="col-6 col-form-label">キーワード検索: </label>
    <div class="col-6 col-lg-3 mb-3">
      <input
        type="text"
        class="form-control"
      />
    </div>

    <div>
      <h5> から までの処置記録</h5>
    </div>

    <div class="scroll">
      <div>
        <p>日付: </p>
        <p class="space"></p>
        <p>登録者: </p>
        <button
          class="btn btn-primary"
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