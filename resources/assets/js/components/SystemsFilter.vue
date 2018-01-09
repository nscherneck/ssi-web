<template>
<div>
<div class="col-lg-3 no-gutter-right">
  <div class="filter">
     
     <i class="fa fa-filter" aria-hidden="true">
       <span>&nbsp;Filter Results</span>
     </i>
     <hr class="filter-horizontal-rule">
     <div class="filter-sort-container">
       <div class="filter-sort-label">
         <span>Sort By</span>
       </div>
       <div>
         <select class="filter-sort-select">
           <option value="name">System Name</option>
           <option value="system_type_id">System Type</option>
           <option value="customer_id">Customer</option>
           <option value="site_id">Site</option>
           <option value="next_test_date">Next Test Date</option>
         </select>
       </div>
     </div>
     <hr class="filter-horizontal-rule">
     
     <label for="filter-input">Name</label>
     <input type="text" class="filter-input" placeholder="Server Room Novec" v-model="filter.name" v-on:keyup="submit">
     
     <label for="filter-input">Components Quantity</label>
     <div class="grid-container">
       <div>
         <input type="text" class="filter-input" placeholder="min" v-model="filter.components_min" v-on:blur="submit">
       </div>
       <div>
         <input type="text" class="filter-input" placeholder="max" v-model="filter.components_max" v-on:blur="submit">
       </div>
     </div>
     
     <label for="filter-input">Tested Between</label>
     <div class="grid-container">
       <div>
         <input type="date" class="filter-input" v-model="filter.test_range_min" placeholder="" v-on:blur="submit">
       </div>
       <div>
         <input type="date" class="filter-input" v-model="filter.test_range_max" placeholder="" v-on:blur="submit">
       </div>
     </div>
     
     <label for="filter-input">Next Test Between</label>
     <div class="grid-container">
       <div>
         <input type="date" class="filter-input" v-model="filter.next_test_min" placeholder="" v-on:blur="submit">
       </div>
       <div>
         <input type="date" class="filter-input" v-model="filter.next_test_max" placeholder="" v-on:blur="submit">
       </div>
     </div>
     
     <label for="filter-input">Servicing Branch Office</label>
     <select class="filter-input" v-model="filter.selected_branch_offices" v-on:click="submit" multiple>
       <option v-for="branch in filter.selectBoxData.branchoffices" :value="branch.id" selected="true">
         {{ branch.name }}
       </option>
     </select>
     
     <label for="filter-input">Customer</label>
     <select class="filter-input" v-model="filter.selected_customers"  v-on:click="submit" multiple>
       <option v-for="customer in filter.selectBoxData.customers" :value="customer.id">{{ customer.name }}</option>
     </select>
     
     <label for="filter-input">System Type</label>
     <select class="filter-input" v-model="filter.selected_system_types" v-on:click="submit" multiple>
       <option v-for="systemtype in filter.selectBoxData.systemtypes" :value="systemtype.id">{{ systemtype.type }}</option>
     </select>
     
     <label for="filter-input">Panel Model</label>
     <select class="filter-input" v-model="filter.selected_panels" v-on:click="submit" multiple>
       <option v-for="panel in filter.selectBoxData.panels" :value="panel.id">
         {{ panel.manufacturer.name + '&nbsp;&nbsp;' + panel.description }}
       </option>
     </select>
     
     <div>
       <input type="checkbox" v-on:change="isActiveToggle" :checked="this.filter.active">
       <label for="filter-checkbox">Active</label>
     </div>
     
     <div>
       <input type="checkbox" v-on:change="isNotActiveToggle" :checked="this.filter.not_active">
       <label for="filter-checkbox">Inactive</label>
     </div>
     
     <hr class="filter-horizontal-rule">
     
     <div>
       <input type="checkbox" v-on:change="ssiTestAccountToggle" :checked="this.filter.ssi_test_account">
       <label for="filter-checkbox">Tests by SSI</label>
     </div>
     
     <div>
       <input type="checkbox" v-on:change="notSsiTestAccountToggle" :checked="this.filter.not_ssi_test_account">
       <label for="filter-checkbox">Tests by Others</label>
     </div>
     
     <hr class="filter-horizontal-rule">
     
     <div>
       <input type="checkbox" v-on:change="ssiInstallToggle" :checked="this.filter.ssi_install">
       <label for="filter-checkbox">Installed by SSI</label>
     </div>
     
     <div>
       <input type="checkbox" v-on:change="notSsiInstallToggle" :checked="this.filter.not_ssi_install">
       <label for="filter-checkbox">Installed by Others</label>
     </div>
     
     <hr class="filter-horizontal-rule">
     
     <br>
     <div>
       <button class="btn btn-sm btn-primary" @click="reset">Clear Filters</button>
     </div>
  </div> <!-- /filter -->
</div> <!-- /column -->
<div class="col-lg-9">
  <h4>Systems ({{ filter.tableData.systems.length }})</h4>
  <hr>
  <systemsindextable :data="filter.tableData.systems"></systemsindextable>
</div>

</div>
</template>
<script>
    import systemsindextable from './SystemsIndexTable.vue';
    export default {
        props: ['customers', 'systemtypes', 'panels', 'branchoffices', 'systems'],
        components: { systemsindextable },
        data() {
          return {
            filter: {
              tableData: {
                systems: this.systems
              },
              selectBoxData: {
                branchoffices: this.branchoffices,
                customers: this.customers,
                systemtypes: this.systemtypes,
                panels: this.panels
              },
              urls: {
                getSystemsEndpoint: '/api/systems',
              },
              name: '',
              selected_branch_offices: [1,2],
              selected_customers: [],
              selected_system_types: [],
              selected_panels: [],
              active: true,
              not_active: true,
              ssi_test_account: true,
              not_ssi_test_account: true,
              ssi_install: true,
              not_ssi_install: true,
              components_min: '',
              components_max: '',
              test_range_min: '',
              test_range_max: '',
              next_test_min: '',
              next_test_max: ''
            },
            params: {
            }
          };
        },
        methods: {
            submit: function() {
              this.process();
              axios.get(
                this.filter.urls.getSystemsEndpoint, 
                {params: this.params}
              )
                .then((response) => {
                  this.filter.tableData.systems = response.data;
                });
            },
            process: function() {
              this.name();
              this.selectedBranchOffices();
              this.selectedCustomers();
              this.selectedSystemTypes();
              this.selectedPanels();
              this.active();
              this.ssiInstall();
              this.ssiTestAccount();
              this.components();
              this.testedBetween();
              this.nextTest();
            },
            name() {
              delete this.params.name;
              if (this.filter.name.length > 0) {
                this.params.name = this.filter.name;
              }
            },
            selectedBranchOffices() {
              delete this.params.branch_office;
              if (this.filter.selected_branch_offices.length > 0) {
                this.params.branch_office = this.filter.selected_branch_offices;
              }
            },
            selectedCustomers() {
              delete this.params.customer;
              if (this.filter.selected_customers.length > 0) {
                this.params.customer = this.filter.selected_customers;
              }
            },
            selectedSystemTypes() {
              delete this.params.type;
              if (this.filter.selected_system_types.length > 0) {
                this.params.type = this.filter.selected_system_types;
              }
            },
            selectedPanels() {
              delete this.params.panel;
              if (this.filter.selected_panels.length > 0) {
                this.params.panel = this.filter.selected_panels;
              }
            },
            active() {
              delete this.params.active;
              if (this.filter.active || this.filter.not_active) {
                this.params.active = [];
                if (this.filter.active) {
                  this.params.active.push(1);
                }
                if (this.filter.not_active) {
                  this.params.active.push(0);
                }
              }
              if (!this.filter.active && !this.filter.not_active) {
                this.params.active = [3];
              }
            },
            ssiInstall() {
              delete this.params.ssi_install;
              if (this.filter.ssi_install || this.filter.not_ssi_install) {
                this.params.ssi_install = [];
                if (this.filter.ssi_install) {
                  this.params.ssi_install.push(1);
                }
                if (this.filter.not_ssi_install) {
                  this.params.ssi_install.push(0);
                }
              }
              if (!this.filter.ssi_install && !this.filter.not_ssi_install) {
                this.params.ssi_install = [3];
              }
            },
            ssiTestAccount() {
              delete this.params.ssi_test_account;
              if (this.filter.ssi_test_account || this.filter.not_ssi_test_account) {
                this.params.ssi_test_account = [];
                if (this.filter.ssi_test_account) {
                  this.params.ssi_test_account.push(1);
                }
                if (this.filter.not_ssi_test_account) {
                  this.params.ssi_test_account.push(0);
                }
              }
              if (!this.filter.ssi_test_account && !this.filter.not_ssi_test_account) {
                this.params.ssi_test_account = [3];
              }
            },
            components() {
              if (this.filter.components_min && this.filter.components_max) {
                delete this.params.components;
                this.params.components = [];
                this.params.components.push(this.filter.components_min);
                this.params.components.push(this.filter.components_max);
              }
            },
            testedBetween() {
              if (this.filter.test_range_min && this.filter.test_range_max) {
                delete this.params.test_range;
                this.params.test_range = [];
                this.params.test_range.push(this.filter.test_range_min);
                this.params.test_range.push(this.filter.test_range_max);
              }
            },
            nextTest() {
              if (this.filter.next_test_min && this.filter.next_test_max) {
                delete this.params.next_test;
                this.params.next_test = [];
                this.params.next_test.push(this.filter.next_test_min);
                this.params.next_test.push(this.filter.next_test_max);
              }
            },
            reset() {
              this.filter.tableData.systems = this.systems,
              this.filter.name = '';
              this.filter.selected_customers = [];
              this.filter.selected_system_types = [];
              this.filter.selected_panels = [];
              this.filter.selected_branch_offices = [1,2];
              this.filter.active= true;
              this.filter.not_active = true;
              this.filter.ssi_test_account = true;
              this.filter.not_ssi_test_account = true;
              this.filter.ssi_install = true;
              this.filter.not_ssi_install = true;
              this.filter.components_min = '';
              this.filter.components_max = '';
              this.filter.last_test_min = '';
              this.filter.last_test_max = '';
              this.filter.next_test_min = '';
              this.filter.next_test_max = '';
            },
            getAllSystems: function() {
              axios.get(this.filter.urls.getSystemsEndpoint)
                .then((response) => {
                  this.filter.tableData.systems = response.data;
                });
            },
            isActiveToggle: function() {
              this.filter.active = !this.filter.active;
              this.submit();
            },
            isNotActiveToggle: function() {
              this.filter.not_active = !this.filter.not_active;
              this.submit();
            },
            ssiTestAccountToggle: function() {
              this.filter.ssi_test_account = !this.filter.ssi_test_account;
              this.submit();
            },
            notSsiTestAccountToggle: function() {
              this.filter.not_ssi_test_account = !this.filter.not_ssi_test_account;
              this.submit();
            },
            ssiInstallToggle: function() {
              this.filter.ssi_install = !this.filter.ssi_install;
              this.submit();
            },
            notSsiInstallToggle: function() {
              this.filter.not_ssi_install = !this.filter.not_ssi_install;
              this.submit();
            }
        }
    }
</script>
<style>
    
</style>
