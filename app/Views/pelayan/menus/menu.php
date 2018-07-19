<div class="row" id="app">
  <div class="col-sm-4">
    <div class="panel panle-default">
      <div class="panel-body">
        <h4>Jumlah Pesanan <span class="pull-right">{{ items.length }}</span></h4>
        <hr>
        <ul v-for="(item, index) in items">
          <li style="margin-bottom:10px;">
            <button @click="removeElement(item)" class="btn btn-danger btn-sm pull-right">&times;</button>
            <div>
              {{ item.nama_menu }}
            </div>
          </li>
        </ul>
        <hr>
        <button class="btn btn-danger btn-block" @click="proses()">Proses</button>
      </div>
    </div>
  </div>
  <div class="col-sm-8">
    <div>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari menu..." v-model="search">
        <span class="input-group-btn">
          <button class="btn btn-deafult" type="button">Cari</button>
        </span>
      </div><!-- /input-group -->
      <br>
      <div class="row" id="">

        <div class="col-sm-6" v-for="(item, index) in filteredItems" v-bind:key="index">
          <div class="thumbnail">
            <a data-fancybox="gallery" v-bind:href="item.url_gambar">
              <img v-bind:src="item.url_gambar">
            </a>
            <div class="caption">
              <h4><strong class="text-danger">Rp {{ item.harga }}</strong></h4>
              <p><strong>{{ item.nama_menu }}</strong></p>
              
              <p>{{ item.keterangan }}</p>
              <p>
                <button class="btn btn-danger btn-lg btn-block" v-on:click="order(item)">PESAN</button>
              </p>
            </div>
          </div>
        </div>
        
      </div>
    </div>

  </div>
</div>


<script>
  $(function() {
    $('#slimScroll').slimScroll({
      height: '500px'
    });
  });

  var app = new Vue({
    el: '#app',
    data() {
      return {
        items: [],
        produks: [],
        search: ''
      }
    },
    mounted () {
      this.loaditem();
    },
    computed: {
      filteredItems() {
        var self = this;
        return this.produks.filter(function(item) {
          return item.nama_menu.toLowerCase().indexOf(self.search.toLowerCase()) > -1
        })
      }
    },
    methods: {
      proses (){
        var self = this;
        if(this.items.length > 0) {
          swal({
            text: 'Silakan masukan nomor meja pemesan!',
            content: "input",
            button: {
              text: "Proses",
              closeModal: false,
            },
          })
          .then(function (no) {

            if(!no) throw "Nomor meja tidak boleh kosong!";

            var data = {
              no: no,
              items: self.items
            };
            axios.post('<?php echo $this->base_url('/pelayan/proses') ?>', data)
              .then(function(json) {
                if(json.data.result) {
                  self.items = [];
                  swal(json.data.message, {
                    icon: 'success'
                  });
                }else{
                  throw "Ada kesalahan sistem pada saat melakukan pesanan!";
                }
                swal.stopLoading();
              })
              .catch(function(err) {
                swal.stopLoading();
                swal(err, {
                  icon: 'warning'
                });
              });
          })
          .catch(function(err) {
            swal(err, {
              icon: 'warning'
            });
          })
        }
      },
      loaditem () {
        var self = this;
        axios.get('<?php echo $this->base_url('/pelayan/items') ?>')
          .then(function(json) {
            self.produks = json.data;
          })
          .catch(function(err) {
            console.log(err);
          })
      },
      removeElement (item) {
        var index = this.items.indexOf(item)
        this.items.splice(index, 1);
      },
      order (json) {
        this.items.push(json);
        Snackbar.show({
          text: json.nama_menu + ' ditambahkan!', pos: 'bottom-center'}); 
      }
    }
  });
</script> 