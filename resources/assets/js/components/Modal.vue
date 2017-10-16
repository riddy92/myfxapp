<template>
    <div class="modal-mask" @click="close" v-show="show">
        <transition name="modal">
            <div class="modal-mask" @click="close" v-show="show">
                <div class="modal-container" @click.stop>
                    <slot></slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: ['show'],

        methods: {
            close() {
                this.$emit('close');
            }
        },

        mounted() {
            document.addEventListener("keydown", (e) => {
                if (this.show && e.keyCode === 27) {
                    this.close();
                }
            });
        }
    }
</script>