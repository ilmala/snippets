var Vue = require('vue');
var CodeMirror = require('codemirror');
require('codemirror/addon/mode/loadmode')
require('codemirror/mode/meta')
require('codemirror/mode/htmlmixed/htmlmixed');
require('codemirror/mode/javascript/javascript');
require('codemirror/mode/jade/jade');
require('codemirror/mode/css/css');
require('codemirror/mode/sass/sass');
require('codemirror/mode/php/php');

var snippetFile = Vue.extend({
  template: '#file',
  data: function(){
    return {
      editor: '',
      cm: null,
      mode: null
    }
  },
  props: ['file', 'index'],
  ready(){

    this.mode = this.findMode(this.file.filename);

    this.cm = CodeMirror.fromTextArea(this.$els.ed, {
      lineNumbers: true,
      tabSize: 2,
      mode: this.mode,
      theme: "material"
    });

  },
  methods: {
    changeName: function(){
      this.mode = this.findMode(this.file.filename);
      this.cm.setOption("mode", this.mode);
    },
    findMode: function(filename){
      var m, mode, spec;
      if (m = /.+\.([^.]+)$/.exec(filename)) {
        var info = CodeMirror.findModeByExtension(m[1]);
        if (info) {
          mode = info.mode;
          spec = info.mime;
        }
      } else if (/\//.test(filename)) {
        var info = CodeMirror.findModeByMIME(filename);
        if (info) {
          mode = info.mode;
          spec = filename;
        }
      } else {
        mode = spec = this.file.filename;
      }

      return mode;
    }
  }
});

var app = new Vue({
  el: '#files',
  props: ['files', 'title'],

  created() {
    this.files = JSON.parse(this.files);
  },

  components: {
    'sn-file': snippetFile
  }
});
