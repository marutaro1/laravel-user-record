<template>
  <div class="mt-2">
    <div class="text-center">
      <p>年齢: </p>
    </div>
    <hr />
  
    <h4>利用者情報更新</h4>

    <label class="col-4 col-form-label">部屋番号:</label>
    <div class="col-4 col-lg-2 mb-1">
      <input
        type="number"
        class="form-control"
        v-model="update_number"
        placeholder="部屋番号"
      />
    </div>

    <label class="col-4 col-form-label">部屋内番号:</label>
    <div class="col-2 col-lg-1 mb-1">
      <select class="form-select form-select-sm">
        <option>0</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
      </select>
    </div>

    <label class="col-4 col-form-label">要介護度:</label>
    <div class="col-6 col-lg-2 mb-3">
      <select class="form-select form-select-sm" v-model="update_care_level">
        <option value="">選択してください</option>
        <option value="自立">自立</option>
        <option value="要支援1">要支援1</option>
        <option value="要支援2">要支援2</option>
        <option value="要介護1">要介護1</option>
        <option value="要介護2">要介護2</option>
        <option value="要介護3">要介護3</option>
        <option value="要介護4">要介護4</option>
        <option value="要介護5">要介護5</option>
      </select>
    </div>

    <button class="btn btn-primary" @click="updateUser">登録</button>
  </div>
</template>
<script>
     export default {
         props: {
             id: String,
             login_user_id: String,
         },
         data() {
           return {
             update_number: '',
             update_care_level: '',
           }
         },
         methods: {
          updateUser() {
              const factoryuser = {
                number: this.update_number,
                care_level: this.update_care_level,
              }
              axios.put('/api/factoryusers/' + this.id, factoryuser).then((res) => {
                console.log(res);
              })
          },
         }
     }
 </script>