<template>
  <div>
    <h3>業務編集</h3>
    <router-link :to="'/staffdaywork/' + login_user_id + '/' + this.today +  '/works'" class="btn btn-primary p-1"
      >戻る</router-link
    >
    <div>
      <div>
        <p>職員名: {{select_staff_daily_works.staff_name}}</p>
        <p>PHS番号: {{ String(select_staff_daily_works.phs).slice(0,3) }}</p>
        <div v-for="(select_staff_daily_work, key) in select_staff_daily_work_array" :key="key">
          <p>
            {{select_staff_daily_work}}:
            <template v-if="change_work_check[key] === '' || change_work_check[key] === 'false'">
              未遂
            </template>
            <template v-else="change_work_check[key] === 'true'">
            完了
            </template>
            <button
              @click="clickChangeWorkCheck(key)"
              class="btn btn-primary p-1"
            >
              <div v-if="change_work_check[key] === '' || change_work_check[key] === 'false'">完了</div>
              <div v-else="change_work_check[key] === 'true'">未遂</div>
            </button>
          </p>
        </div>
      </div>
      
      <div>
        <label class="col-2 col-form-label">メモ:</label>
        <div class="col-lg-5 col-8">
          <textarea class="form-control" v-model="staff_memo"></textarea>
        </div>
      </div>
      <button
        @click="postCompleteWorkCheck(select_staff_daily_works.staff_name, select_staff_daily_works.phs.slice(0,3))"
        class="my-2 btn btn-primary"
      >
        登録
      </button>
    </div>
  </div>
</template>
<script>
     export default {
         props: {
             login_user_id: String,
             select_staff_id: String,
             today: String,
             user_department: String,
         },
         data() {
           return {
             select_staff_data: {},
             select_staff_daily_works: [],
             select_staff_daily_work_array: [],
             change_work_check: [],
             work_check: [],
             staff_memo: '',
             staff_name: '・',
             complete_work_id: '',
           }
         },
         methods: {
           clickChangeWorkCheck(key){
             if(this.change_work_check[key] === 'false' || this.change_work_check[key] === '') {
               this.change_work_check[key] = 'true';
             
             } else if(this.change_work_check[key] === 'true') {
               this.change_work_check[key] = 'false';
             }
           },
            getSelectStaffDailyWorks() {
              axios.get('/api/staff_daily_work/' + this.today + '/' + this.user_department + '/' + this.select_staff_id).then((res) => {               
                    this.select_staff_daily_works = res.data[0];
                    const array_data =  res.data[0].works.split(',');
                    this.select_staff_daily_work_array =  Object.assign({}, array_data);
                      for(let n = 0; n < array_data.length; n++) {
                        this.change_work_check.push('');
                      }
                
              }).then(() => {
                this.postCompleteWorkCheck(this.select_staff_daily_works.staff_name, this.select_staff_daily_works.phs);
                this.getCompleteWorkCheck();
              })
            },
            postCompleteWorkCheck(name, phs) {
              console.log(phs)
              axios.get('/api/users/name/' + name).then(() => {
                const array = [];
                let responce_work = '';
                let error_data = '';
                for (let i = 0; i < this.change_work_check.length; i++) {
                  array.push('');
                }
                axios.get('/api/complete_works/' + this.today + '/' + this.select_staff_id).then((responce) => {
                  responce_work = responce;
                  console.log(responce)
                  console.log(responce_work.data)
                }).then(() => {


                if(responce_work.data.length === 0) {

                  this.staff_memo = '・';
      
                  let add_work_check = {
                    staff_id: phs,
                    staff_name: this.select_staff_id,
                    day: this.today,
                    work_check: String(this.change_work_check),
                    staff_memo: this.staff_memo,
                  }
                   axios.post('/api/complete_works/' + this.today, add_work_check).then((res) => {
                    console.log(res.data)
                    this.staff_memo = res.data.staff_memo;
                  });

                } else if(this.staff_memo === '' && array !== this.change_work_check && responce_work.data.length !== 0) {
                  console.log(responce_work.data)

                  this.staff_memo = '・';

                  let add_work_check = {
                    staff_id: phs,
                    staff_name: this.select_staff_id,
                    day: this.today,
                    work_check: String(this.change_work_check),
                    staff_memo: this.staff_memo,
                  }
                  axios.post('/api/complete_works/' + this.today + '/' + this.select_staff_id, add_work_check).then((res) => {
                    console.log(res.data)
                    this.staff_memo = res.data.staff_memo;
                  });

                } else {
                  let add_work_check = {
                    staff_id: phs,
                    staff_name: this.select_staff_id,
                    day: this.today,
                    work_check: String(this.change_work_check),
                    staff_memo: this.staff_memo,
                  }
                  axios.post('/api/complete_works/' + this.today + '/' + this.select_staff_id, add_work_check).then((res) => {
                    console.log(res.data)
                    this.staff_memo = res.data.staff_memo;
                  });
                
                }
                })
              });

              
            },
            getCompleteWorkCheck() {
                axios.get('/api/complete_works/' + this.today + '/' + this.select_staff_id).then((res) => {
                        if(res.data.length === 0) {
                          console.log(res.data); 
                        }
                        else { 
                          console.log(res.data); 
                          this.change_work_check = res.data[0].work_check.split(',');
                          console.log(this.change_work_check); 
                          this.staff_memo = res.data[0].staff_memo;
                          this.complete_work_id = res.data[0].id;
                        }
                });

            }
         },
         created() {
            axios.get('/api/users/name/' + this.select_staff_id).then((responce) => {
                 this.select_staff_data = responce.data[0]
            });
            console.log(this.select_staff_id)
            this.getSelectStaffDailyWorks();
         }
     }
 </script>