<template>
  <div  class="mt-2">
    <div class="text-center">
      <p>年齢: </p>
    </div>
    <hr />
    <h4>既往歴</h4>

    <div>
      <label class="col-form-label col-5">発症日:</label>
      <div class="col-6 col-lg-3 mb-2">
        <input type="date" class="form-control" />
      </div>
      <div class="col-10 col-lg-6 mb-3">
        <textarea  class="form-control"> </textarea>
      </div>
      <button class="btn btn-primary">
        登録
      </button>
    </div>
    <hr />
    <div>
      <label class="col-form-label col-5">既往歴更新:</label>
      <div class="col-6 col-lg-3 mb-2">
        <input type="date" class="form-control" />
      </div>
      <div class="col-10 col-lg-6 mb-2">
        <textarea
          class="form-control"
        ></textarea>
      </div>
    </div>
    <hr />
    <div>
      <label class="col-5 col-form-label">日付指定既往表示:</label>

      <div class="col-6 mb-2">
        <input type="date" class="form-control" />
        <p class="m-0 p-0">から</p>
        <input type="date" class="form-control" />
      </div>
      <button class="btn btn-primary px-1">
        {{ dayKeywordFirst }}-{{ dayKeywordSecond }}分表示
      </button>
      <button class="btn btn-primary px-1 mx-2">クリア</button>
    </div>
    <hr />

    <div v-if="!!dayKeywordFirst && !!dayKeywordSecond">
      <h5>{{ dayKeywordFirst }}から{{ dayKeywordSecond }}までの既往</h5>
    </div>
    <div v-else>
      <h5>既往歴</h5>
    </div>
    <div>
      <label class="col-5 col-form-label">病名検索:</label>
      <div class="col-6 col-lg-3 mb-2">
        <input
          type="text"
          class="form-control"
        />
        <datalist id="medicalHistory">
          <option>
          ここに既往歴
          </option>
        </datalist>
      </div>
    </div>

    <div class="scroll">
      <div >
        <p>日付: </p>
        <p></p>
        <button
          
          class="btn btn-primary px-0 col-2 col-lg-1"
        >
          更新
        </button>
        <button
          
          class="btn btn-primary px-0 mx-2 col-2 col-lg-1"
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