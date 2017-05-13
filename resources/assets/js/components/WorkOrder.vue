<script>
    export default {
        props: ['attributes'],

        data() {
            return {
                editing: false,
                title: this.attributes.title,
                scope_of_work: this.attributes.scope_of_work
            };
        },

        methods: {
            update() {
                axios.patch('/workorders/' + this.attributes.id, {
                    title: this.title,
                    scope_of_work: this.scope_of_work
                });

                this.editing = false;
            },
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
