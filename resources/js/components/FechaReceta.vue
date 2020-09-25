<template>
    <span v-text="formatearFecha"></span>
</template>


<script>
    export default {
        props: ['fecha'],
        // Al cargarse el componente
        mounted() {
            console.log('Se recibió el prop', this.fecha);
        },
        // Similar al useEffect() de react
        computed: {
            formatearFecha() {
                return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY');
            }
        },
    }
</script>