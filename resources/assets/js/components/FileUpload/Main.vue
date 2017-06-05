<template>
    <div id="fileContainer">
        <div v-show="!file">
            <label v-show="withLabel">Select an file</label>
            <input type="file" :name="name ? name : 'fileInput'" :id="inputId ? inputId : 'fileInput'" @change="onFileChange">
        </div>
        <div v-show="file">
            <span :name="fileName">{{fileName}}</span>
            <button @click="removeFile">Remove file</button>
        </div>
    </div>
</template>
<style>
    #fileContainer {
        text-align: left;
    }
    img {
        width: 30%;
        margin: auto;
        display: block;
        margin-bottom: 10px;
    }
    button {

    }
</style>
<script>
    export default {
        data() {
            return {
                file: null,
                fileName: ''
            }
        },
        props: ['name', 'inputId', 'withLabel'],
        methods: {
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.file = files[0];
                this.fileName = files[0].name;
            },
            removeFile: function (e) {
                this.file = null;
                this.fileName = '';
            }
        }
    }
</script>