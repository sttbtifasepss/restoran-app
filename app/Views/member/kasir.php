<div id="app" class="row">
  <div class="col-sm-6">
    <div class="panel panel-white">
      <div class="panel-body">
        <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">#</span>
          <input type="text" v-model="search" class="form-control" placeholder="Cari Invoice..." aria-describedby="basic-addon1">
        </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>Invoice</th>
              <th>Status Bayar</th>
              <th>Tgl</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in filteredItems">
              <td>#{{ item.no_order }}</td>
              <td>{{ item.status_bayar }}</td>
              <td>{{ item.tgl_order }}</td>
              <td>
                <button class="btn btn-block btn-primary" @click="detailOrder(item)">Bayar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="panel panel-white">
      <div class="panel-body">
      <div class="row" v-if="detail.parent != undefined">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-6">
                <address>
                  <h3>#{{ detail.parent.no_order }}</h3>
                  <strong>No Meja</strong>
                  <p>{{ detail.parent.no_meja }}</p>
                  <strong>Status</strong>
                  <p>{{ detail.parent.status }}</p>
                </address>  
              </div>
              <div class="col-sm-6">
                <address>
                  <strong>Tanggal Order</strong>
                  <p>{{ detail.parent.tgl_order }}</p>
                  <strong>Jumlah Order</strong>
                  <p>{{ orders.length }} item</p>
                  <strong>Status Bayar</strong>
                  <p>{{ detail.parent.status_bayar }}</p>
                </address>
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <table class="table">
              <thead>
                <tr>
                  <th>Menu</th>
                  <th>Jumlah</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in detail.items">
                  <td>{{ item.nama_menu }}</td>
                  <td>1</td>
                  <td class="text-right"><span class="pull-left">Rp</span> {{ item.harga }}</td>
                </tr>
              </tbody>

              <tfoot>
                <tr>
                  <td colspan="2" class="text-right">
                    <h4>Total Bayar</h4>
                  </td>
                  <td class="text-right">
                    <h4><span class="pull-left">Rp</span> {{ detail.total_bayar }}</h4>
                  </td>
                </tr>
              </tfoot>
            </table>

            <div class="text-right">
              <button class="btn btn-danger" @click="bayar()">Bayar Sekarang</button>
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
          items: [],
          total_bayar: 0
        }
      }
    },
    computed: {
      filteredItems() {
        var self = this;
        return this.orders.filter(function(item) {
          return item.no_order.toLowerCase().indexOf(self.search.toLowerCase()) > -1
        })
      }
    },
    mounted() {
      var self = this;
      this.loadOrders();
    },
    methods : {
      bayar () {
        var self = this;
        swal('Anda yakin ?', {
          buttons: true
        }).then(function(status) {
          if(status) {
            axios.post('<?php echo $this->base_url('/kasir/bayar') ?>', self.detail)
              .then(function(json) {
                if(json.data.result) {
                  self.detail = [];
                  self.loadOrders();
                  self.search = '';
                  swal(json.data.message, {
                    icon: 'success'
                  });
                }else{
                  throw "Ada kesalahan sistem pada saat melakukan pesanan!";
                }
              })
              .catch(function(err) {
                swal(err, {
                    icon: 'success'
                  });
              })
          }
        });
      },
      detailOrder(item) {
        var self = this;
        this.detail = {
          ...this.detail,
          parent: item
        }

        axios.get('<?php echo $this->base_url('/kasir/detail/') ?>' + item.id)
          .then(function(json) {
            self.detail = {
              ...self.detail,
              items: json.data.items,
              total_bayar: json.data.total_bayar
            };
          })
      },
      loadOrders () {
        var self = this;
        axios.get('<?php echo $this->base_url('/kasir/orders') ?>')
          .then(function(json) {
            self.orders = json.data;
          })
      },
    }
  });
</script>