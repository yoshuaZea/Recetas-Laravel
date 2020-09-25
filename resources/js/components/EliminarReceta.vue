<template>
    <input 
        type="submit" 
        class="btn btn-danger w-100 mb-2" 
        value="Eliminar ×" 
        @click="eliminarReceta"
    />
</template>
<script>
    //  Evento en VUE: v-on:click="eliminarReceta"
    export default {
        props: ['recetaId'],
        mounted() {
            // console.log('Receta actual', this.recetaId);
        },
        methods: {
            eliminarReceta() {
                this.$swal({
                    title: '¿Deseas eliminar esta receta?',
                    text: "Una receta eliminada no se puede recuperar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si!',
                    cancelButtonText: 'No'
                    }).then((result) => {
                    if (result.value) {
                        const params = {
                            id: this.recetaId
                        }

                        // Enviar petición al servidor
                        axios.post(`/recetas/${this.recetaId}`, { 
                            params, 
                            _method: 'delete' 
                            }).then(respuesta => {
                                this.$swal({
                                    title: 'Receta eliminada!',
                                    text:'Se eliminó la receta',
                                    icon: 'success'
                                })

                                // Eliminar receta del DOM
                                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode)

                            }).catch(error => {
                                console.log(error);
                                this.$swal({
                                    title: 'Oops... Hubo un error!',
                                    text:'Hubo un error con tu petición',
                                    icon: 'error'
                                })
                            })

                        
                    }
                })
            }
        }
    }
</script>