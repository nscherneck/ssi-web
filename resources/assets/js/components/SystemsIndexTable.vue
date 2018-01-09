<template>
    <div class="table-responsive">

      <table class="table table-condensed">
      <thead>
        <tr>
          <th><small>System</small></th>
          <th><small>Type</small></th>
          <th><small>Next Test Date</small></th>
          <th><small>Components</small></th>
        </tr>
      </thead>

      <tbody>
          <tr v-for="system in data">
            <td>
              <small>
                <a :href="system.site.customer.path">
                  {{ system.site.customer.name }}
                </a>
                -
                <a :href="system.site.path">
                  {{ system.site.name }}
                </a>
                -
                <a :href="system.path">
                    {{ system.name }}
                </a>
              </small>
            </td>

            <td>
              <small>
                {{ system.system_type.type }}
              </small>
            </td>

            <td>
              <small>
                {{ system.next_test_date | nextTestDateFormat }}
              </small>
            </td>

            <td class="text-center">
              <small>
                {{ system.componentsQuantity }}
              </small>
            </td>

          </tr>
      </tbody>

      </table>
    </div> <!-- END OF RESPONSIVE TABLE -->
</template>
<script>
    import moment from 'moment';
    export default {
        props: ['data'],
        data() {
            return {
                
            }
        },
        methods: {
          nextTestDateFormat: function () {
            return nextTestDateFormat();
          },
          latestTestDateFormat: function () {
            return latestTestDateFormat();
          }
        },
        filters: {
          nextTestDateFormat: function (date) {
            if (date) {
              return moment(date).format('MMMM YYYY');
            }
          },
          latestTestDateFormat: function (date) {
            if (date) {
              return moment(date).format('MMMM D, YYYY');
            }
          }
        }
    }
</script>
<style>
    
</style>
