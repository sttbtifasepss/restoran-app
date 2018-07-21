<div class="row" id="app">
  <div class="col-sm-4">
    <div class="panel panel-white">
      <div class="panel-heading">Daftar Pesanan <span class="pull-right">{{ orders.length }}</span></div>
      <div class="list-group">
        <a href="javascript:void(0);" @click="detailOrder(order)" class="list-group-item" v-for="(order, index) in orders">
          <small class="pull-right">{{ order.tgl_order }}</small>
          <strong>
            {{ order.id }}. Invoice #{{ order.no_order }}
          </strong>
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-8">
    <div class="panel panel-white">
      <div class="panel-body">
        
        <div class="row" v-if="detail.parent != undefined">
          <div class="col-sm-4">
            <address>
              <strong>Invoice</strong>
              <p>#{{ detail.parent.no_order }}</p>
              <strong>No Meja</strong>
              <p>{{ detail.parent.no_meja }}</p>
              <strong>Status</strong>
              <p>{{ detail.parent.status }}</p>
              <strong>Tanggal Order</strong>
              <p>{{ detail.parent.tgl_order }}</p>
              <strong>Jumlah Order</strong>
              <p>{{ orders.length }} item</p>
            </address>
            <hr>
            <button class="btn btn-primary btn-block" @click="finish(detail.parent)">Masak Selesai</button>
          </div>
          <div class="col-sm-8">
            <div class="col-sm-6" v-for="(item, index) in filteredItems" v-bind:key="index">
              <div class="thumbnail">
                <a data-fancybox="gallery" v-bind:href="item.url_gambar">
                  <img v-bind:src="item.url_gambar">
                </a>
                <div class="caption">
                  <h4><strong class="text-danger">Rp {{ item.harga }}</strong></h4>
                  <p><strong>{{ item.nama_menu }}</strong></p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div v-else>
          Silakan Klik salah satu nomor invoice di samping!
        </div>

      </div>
    </div>
  </div>
</div>



<script>
  var vue = new Vue({
    el: '#app',
    data () {
      return {
        search: '',
        orders: [],
        detail: {
          items: []
        }
      }
    },
    computed: {
      filteredItems() {
        var self = this;
        return this.detail.items.filter(function(item) {
          return item.nama_menu.toLowerCase().indexOf(self.search.toLowerCase()) > -1
        })
      }
    },
    mounted() {
      var self = this;
      this.loadOrders();

      setInterval(function() {
        self.loadOrders();
      }, 3000);
    },
    methods: {
      detailOrder(item) {
        var self = this;
        this.detail = {
          ...this.detail,
          parent: item
        }

        axios.get('<?php echo $this->base_url('/koki/detail/') ?>' + item.id)
          .then(function(json) {
            self.detail = {
              ...self.detail,
              items: json.data
            };
          })
      },
      loadOrders () {
        var self = this;
        axios.get('<?php echo $this->base_url('/koki/orders') ?>')
          .then(function(json) {
            self.orders = json.data;
            self.detailOrder(json.data[0]);
          })
      },
      finish (item) {
        var self = this;
        swal("Anda yakin pesanan ini sudah selsai ?", {
          buttons: true
        }).then(function (status) {
          if(status) {
            axios.post('<?php echo $this->base_url('/koki/selesai') ?>', item)
              .then(function(json) {
                if(json.data.result) {
                  self.detail = [];
                  swal(json.data.message, {
                    icon: 'success'
                  });
                }else{
                  throw "Ada kesalahan sistem pada saat melakukan pesanan!";
                }
              }).catch(function(err) {
                swal(err, {
                    icon: 'success'
                  });
              });
          }
        });
      }
    }
  });
</script>