<template>
  <div class="mt-2" @mousemove.once="getRecord">
    <hr />
    <h4>記録</h4>
    <div>
      <label class="col-4 col-form-label mb-1">新規記録入力:</label>
      <div class="col-8 col-lg-3 mb-3">
        <input type="datetime-local" class="form-control" v-model="day" />
      </div>
      <div class="col-10 col-lg-6 mb-3">
        <textarea class="form-control" v-model="record_value"> </textarea>
      </div>
      <button @click="submit" class="btn btn-primary mx-1">登録</button>
    </div>

    <hr />

    <div>
      <label class="col-4 col-form-label">記録更新:</label>
      <div class="col-8 col-lg-3 mb-3">
        <input type="datetime-local" class="form-control" v-model="update_day" />
      </div>
      <div class="col-10 col-lg-6">
        <textarea class="form-control" v-model="update_record_value"></textarea>
      </div>
      <br />
    </div>

    <hr />

    <div>
      <label lass="col-2 col-form-label">各月の記録抽出:</label>
      <div class="col-6 my-2">
        <input type="month" class="form-control" v-model="select_month" />
      </div>
      <button
       @click="getRecord"
        class="btn btn-primary px-1"
      >
       表示
      </button>
    </div>

    <hr />

    <div>
      <label class="col-5 col-form-label">日付指定記録抽出:</label>

      <div class="col-6 mb-2">
        <input type="date" class="form-control" v-model="dayKeywordFirst" />
        <p class="m-0 p-0">から</p>
        <input type="date" class="form-control" v-model="dayKeywordSecond" />
      </div>
      <button @click="getRecord" class="btn btn-primary px-1">
       表示
      </button>
      <button class="btn btn-primary px-1 mx-2">クリア</button>
    </div>

    <hr />
    
    <div>
      <div v-if="!select_month && !dayKeywordFirst && !dayKeywordSecond">
        <h5>{{ no_select_view_day }}の記録</h5>
      </div>
      <div v-else-if="select_month">
        <h5>{{select_month}}の記録</h5>
      </div>
      <div v-else-if="dayKeywordFirst && dayKeywordSecond && !select_month">
        <h5>{{dayKeywordFirst}}から{{dayKeywordSecond}}までの記録</h5>
      </div>

      <label class="col-6 col-form-label mb-1">キーワード検索:</label>
      <div class="col-6 mb-3">
        <input
          type="text"
          class="form-control"
          v-model="keyword"
          @blur="recordSerch"
          list="record_data"
        />
      </div>

      <div class="overflow-auto" style="height:300px;">
        <div v-for="(record,key) in recordArray" :key="key">

          <p>日付: {{record.day}}</p>
          <p class="space">{{record.record_value}}</p>
          <p>登録者: {{record.staff_name}}</p>
          <button
            class="col-2 col-lg-1 btn btn-primary px-0"
            @click="updateRecord(record.id)"
          >
            更新
          </button>
          <button
            class="col-2 col-lg-1 btn btn-primary px-0 mx-2"
            @click="destoryRecord(record)"
          >
            削除
          </button>
          <button
            class="col-5 col-lg-2 btn btn-primary px-0"
            @click="postArchives(record)"
          >
            記録まとめへ追加
          </button>
          <hr />
        </div>
      </div>
    </div>
    
    <div class="text-center mt-1">
      <p>{{ currentPage + 1 }}ページ</p>
      <div class="container">
        <nav>
          <ul class="pagination" style="justify-content: center">
            <li class="page-item">
              <a @click="first" class="page-link">&laquo;</a>
            </li>
            <li class="page-item">
              <a @click="prev" class="page-link">&lt;</a>
            </li>

            <li v-for="i in displayPageRange" :key="i" class="page-item">
              <a @click="pageSelect(i)" class="page-link">{{ i }}</a>
            </li>

            <li class="page-item">
              <a @click="next" class="page-link">&gt;</a>
            </li>
            <li class="page-item">
              <a @click="last" class="page-link">&raquo;</a>
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
             id: String,
             login_user_id: String,
         },
         data() {
           return {
             real_date: new Date().getFullYear() +
                        "-" +
                        ("00" + (new Date().getMonth() + 1)).slice(-2) +
                        "-" +
                        ("00" + new Date().getDate() ).slice(-2) +
                        "T" +
                        ("00" + new Date().getHours()).slice(-2) +
                        ":" +
                        "00", //入力した日付を格納する値
            
             day: new Date().getFullYear() +
                        "-" +
                        ("00" + (new Date().getMonth() + 1)).slice(-2) +
                        "-" +
                        ("00" + new Date().getDate() ).slice(-2) +
                        "T" +
                        ("00" + new Date().getHours()).slice(-2) +
                        ":" +
                        "00",
             record_value: '',
             staff_name: 'staff',
             factoryuser_record_data: {},
             select_day_list: [],
             update_day: '',
             update_record_value: '',
             keyword: '',
             dayKeywordFirst: '',
             dayKeywordSecond: '',
             start_day: new Date().getFullYear() +
                        "-" +
                        ("00" + (new Date().getMonth() + 1)).slice(-2) + "-01",
             end_day: new Date().getFullYear() +
                        "-" +
                        ("00" + (new Date().getMonth() + 1)).slice(-2) + "-31",
             select_month: '',
             no_select_view_day: new Date().getFullYear() +
                        "-" +
                        ("00" + (new Date().getMonth() + 1)).slice(-2),
             login_user: [],
             serch_responce: [],

             //<---- ページネーション処理 ---->
            currentPage: 0, // 現在のページ番号
            size: 10, // 1ページに表示するアイテムの上限
            pageRange: 6, // ページネーションに表示するページ数の上限
            items: [], // 表示するアイテムリスト
            head: '',
            arrayData: [],
            half: 0,
            dataArrays: []
           }
         },

         computed: {


            recordArray() {
              //this.displayItems(this.serchRecords);
              this.displayItems(this.serch_responce);
                return this.arrayData;
              },
             //ページ数を取得する
             pages() {
              return Math.ceil(this.items.length / this.size);
            },
            // ページネーションで表示するページ番号の範囲を取得する
            displayPageRange() {
              this.half = Math.ceil(this.pageRange / 2);

              let start = 0;
              let end = 0;

              if (this.pages < this.pageRange) {
                // ページネーションに表示する上限よりページ数がすくない場合
                start = 1;
                end = this.pages;
              } else if (this.currentPage < this.half) {
                //前半3ページ
                start = 1;
                end = start + this.pageRange - 1;
              } else if (this.pages - this.half - 1 < this.currentPage) {
                //後半3ページ
                end = this.pages
                start = end - this.pageRange + 1;
              } else {
                //現在のページを真ん中に表示
                start = this.currentPage - this.half + 1;
                end = this.currentPage + this.half;
              }
              const indexes = [];
              for (let i = start; i <= end; i++) {
                indexes.push(i);
              }
              // console.log("indexes" + indexes);
              return indexes;
            }



         },

         methods: {
           getLoginUser() {
                axios.get('/api/users/' + this.login_user_id).then((res) => {
                        this.login_user = res.data;
                        return this.login_user;
                })
            },

           submit() {
             const record_data = {
               day: this.day,
               day_record_check: true,
               record_value: this.record_value,
               staff_name: this.login_user.name,
               factoryuser_id: this.id,
             }
             axios.post('/api/factoryusers/' + this.id + '/records', record_data).then((res) => {

                axios.get('/api/factoryusers/' + this.id).then((responce) => {
                  console.log(responce)
                  if( new Date( responce.data[0].day_record_check + 'T00:00' ).getTime() <= new Date ( this.day ).getTime() || responce.data[0].day_record_check === '・' || responce.data[0].day_record_check === '.') {
                    const factoryuser = {
                      factoryuser_name: this.factoryuser_name,
                      birthday: this.birthday,
                      care_level: this.care_level,
                      number: this.number,
                      day_record_check: this.day.slice(0,10),
                    }
                    axios.put('/api/factoryusers/' + this.id, factoryuser).then((res) => {
                      console.log(res);
                      this.getRecord();
                      this.record_value = '';
                      this.day = this.real_date;
                    })
                  }
                })

             })
           },

           updateRecord(record_id) {
             const record = {
               id: record_id,
               day: this.update_day,
               day_record_check: true,
               record_value: this.update_record_value,
               staff_name: this.login_user.name,
               factoryuser_id: String(this.id)
             }
             axios.put('/api/factoryusers/factoryuser/records/' + record_id, record).then((res) => {

                  axios.get('/api/factoryusers/' + this.id).then((responce) => {
                  console.log(responce)
                  if( new Date( responce.data[0].day_record_check + 'T00:00' ).getTime() <= new Date ( this.update_day ).getTime() ) {
                    const factoryuser = {
                      factoryuser_name: this.factoryuser_name,
                      birthday: this.birthday,
                      care_level: this.care_level,
                      number: this.number,
                      day_record_check: this.update_day.slice(0,10),
                    }
                    axios.put('/api/factoryusers/' + this.id, factoryuser).then((res) => {

                     console.log(res);
                     this.getRecord();
                     this.update_record_value = '';
                     this.update_day = '';
                     
                    })
                  }
                })
             })
           },

           getRecord() {
              if(this.start_day === '' && this.end_day === '' && this.dayKeywordFirst === '' && this.dayKeywordSecond === '' && this.select_month === '') {
                const day_first = this.real_date.slice(0,7);
                this.start_day =  day_first + '-01'
                if(Number(day_first.slice(6,7))+ 1 < 10) {
                  this.end_day = day_first.slice(0,5) + 0 + String(Number(day_first.slice(6,7))+ 1).slice(-1)  + '-01'
                }
                else if (Number(day_first.slice(6,7))+ 1 >= 10) {
                    this.end_day = day_first.slice(0,5) + Number(day_first.slice(6,7))+ 1  + '-01'
                }
              }
              else if(this.select_month !== '') {
                 
                this.start_day =  this.select_month + '-01'
                if(Number(this.start_day.slice(6,7))+ 1 < 10) {
                  this.end_day = this.start_day.slice(0,5) + 0 + String(Number(this.start_day.slice(6,7))+ 1).slice(-1)  + '-01'
                }
                else if (Number(this.start_day.slice(6,7))+ 1 >= 10) {
                    this.end_day = this.start_day.slice(0,5) + Number(this.start_day.slice(6,7))+ 1  + '-01'
                }
              }
              else if(this.dayKeywordFirst !== '' && this.dayKeywordSecond !== '') {
                    this.start_day = this.dayKeywordFirst;
                    const number_end_day = new Date(this.dayKeywordSecond + 'T00:00:00');
                    let next_month = '';
                    let next_day = '';
                    let year = this.dayKeywordSecond.slice(0,4);

                    if(number_end_day.getMonth() + 1 < 10) {
                      next_month = (0 +  String(number_end_day.getMonth() + 1));
                      console.log(1)
                    }
                    else if (number_end_day.getMonth()+ 1 === 12 && number_end_day.getDate() + 1 === 32) {
                      year = String(Number(year) + 1);
                      next_month = '01';
                      next_day = '01';
                      console.log(2)
                    }
                    else if (number_end_day.getMonth()+ 1 >= 10 && number_end_day.getMonth()+ 1 < 13) {
                      next_month = String(number_end_day.getMonth() + 1);
                      console.log(3)
                    }

                    if (number_end_day.getMonth()+ 1 === 12 && number_end_day.getDate() + 1 === 32) {
                      console.log(4)
                    }
                    else if(number_end_day.getDate()+ 1 < 10) {
                      next_day = 0 +  String(number_end_day.getDate() + 1);
                      console.log(5)
                    }
                    else if (number_end_day.getDate() + 1 === 32 && number_end_day.getMonth() + 1 !== 12) {
                      next_month = String(number_end_day.getMonth() + 2);
                      next_day = '01';
                      console.log(6)
                    }
                    else if (number_end_day.getDate() + 1 >= 10 && number_end_day.getDate() + 1 < 32) {
                      next_day = String(0 +  number_end_day.getDate() + 1);
                      console.log(7)
                    }

                    this.end_day = year + '-' + next_month + '-' + next_day;
                  }
                  console.log(this.start_day + '/' + this.end_day)
                     axios.get('/api/factoryusers/' + this.id + '/records/' + this.start_day + '/' + this.end_day).then((res) => {
                        this.serch_responce = res.data;
                        console.log(res.data);
                     });
           },


           destoryRecord(record_data) {
             axios.delete('/api/factoryusers/factoryuser/records/' + record_data.id).then(() => {
                this.getRecord();

                axios.get('/api/factoryusers/' + this.id).then((responce) => {
                  if( responce.data[0].day_record_check === record_data.day.slice(0,10) ) {
                    console.log(this.serch_responce)
                    
                      const day_record_check_value = this.serch_responce[1].day.slice(0,10);
                      console.log(day_record_check_value)

                      const factoryuser = {
                        factoryuser_name: this.factoryuser_name,
                        birthday: this.birthday,
                        care_level: this.care_level,
                        number: this.number,
                        day_record_check: day_record_check_value,
                      }
                      axios.put('/api/factoryusers/' + this.id, factoryuser).then((res) => {
                        console.log(res.data);
                      })
                  }

                })
             })
           },

           
           postArchives(record) {
             let user_name = '';
             let user_number = '';
             axios.get('/api/factoryusers/' + this.id).then((responce) => {
               console.log(responce.data[0])
               user_name = responce.data[0].factoryuser_name;
               user_number = responce.data[0].number;
             }).then(() => {

             const post_archive_value = {
               factoryuser_id: this.id,
               factoryuser_name: user_name,
               factoryuser_number: user_number,
               staff_id: this.login_user_id,
               staff_name: this.login_user.name,
               day: this.real_date.slice(0,10),
               archive_record: record.record_value,
               archive_memo: '・',
             }
              axios.post('/api/archives/' + this.real_date.slice(0,10), post_archive_value);
             })
           },

            sortArray(array) {
              //日付順に並び替える
              this.dataArrays = array
                .slice()
                .sort((a, b) => {
                  return Number(new Date(a.day)) - Number(new Date(b.day));
                })
                .reverse();
            },

      
            recordSerch() {
              if(this.keyword === '') {
                this.getRecord();
                return;
              }
              else if(this.start_day === '' && this.end_day === '' && this.dayKeywordFirst === '' && this.dayKeywordSecond === '' && this.select_month === '') {
                const day_first = this.real_date.slice(0,7);
                this.start_day =  day_first + '-01'
                if(Number(day_first.slice(6,7))+ 1 < 10) {
                  this.end_day = day_first.slice(0,5) + 0 + String(Number(day_first.slice(6,7))+ 1).slice(-1)  + '-01'
                }
                else if (Number(day_first.slice(6,7))+ 1 >= 10) {
                    this.end_day = day_first.slice(0,5) + Number(day_first.slice(6,7))+ 1  + '-01'
                }
              }
              else if(this.dayKeywordFirst !== '' && this.dayKeywordSecond !== '') {
                    const number_end_day = new Date(this.dayKeywordSecond + 'T00:00:00');
                    let next_month = '';
                    let next_day = '';
                    let year = this.dayKeywordSecond.slice(0,4);

                    if(number_end_day.getMonth() + 1 < 10) {
                      next_month = (0 +  String(number_end_day.getMonth() + 1));
                      console.log(1)
                    }
                    else if (number_end_day.getMonth()+ 1 === 12 && number_end_day.getDate() + 1 === 32) {
                      year = String(Number(year) + 1);
                      next_month = '01';
                      next_day = '01';
                      console.log(2)
                    }
                    else if (number_end_day.getMonth()+ 1 >= 10 && number_end_day.getMonth()+ 1 < 13) {
                      next_month = String(number_end_day.getMonth() + 1);
                      console.log(3)
                    }

                    if (number_end_day.getMonth()+ 1 === 12 && number_end_day.getDate() + 1 === 32) {
                      console.log(4)
                    }
                    else if(number_end_day.getDate()+ 1 < 10) {
                      next_day = 0 +  String(number_end_day.getDate() + 1);
                      console.log(5)
                    }
                    else if (number_end_day.getDate() + 1 === 32 && number_end_day.getMonth() + 1 !== 12) {
                      next_month = String(number_end_day.getMonth() + 2);
                      next_day = '01';
                      console.log(6)
                    }
                    else if (number_end_day.getDate() + 1 >= 10 && number_end_day.getDate() + 1 < 32) {
                      next_day = String(0 +  number_end_day.getDate() + 1);
                      console.log(7)
                    }

                    this.end_day = year + '-' + next_month + '-' + next_day;
              }
        

              console.log(this.start_day)
              console.log(this.end_day)
              axios.get('/api/' + this.id + '/serch/' + this.keyword + '/' + this.start_day + '/' + this.end_day).then((res) => {
                this.serch_responce = res.data;
              })
            },

           // 現在のページで表示するアイテムリストを取得する
            displayItems(array) {
              this.head = this.currentPage * this.size;
              this.items = array;
              this.arrayData = array.slice(this.head, this.head + this.size); //0 ~ 10までの配列を表示させる
            },

            //ページ先頭に移動する
            first() {
              this.currentPage = 0;
            },

            //ページ最後に移動する
            last() {
              this.currentPage = this.pages - 1;
            },

            //1ページ前に移動する

            prev() {
              if (0 < this.currentPage) {
                this.currentPage--;
              }
            },

            //1ページ次に移動する
            next() {
              if (this.currentPage < this.pages - 1) {
                this.currentPage++;
              }
            },

            //指定したページに移動する
            pageSelect(index) {
              this.currentPage = index - 1;
            },

         },
         mounted() {
           this.getLoginUser();
         }
     }
 </script>