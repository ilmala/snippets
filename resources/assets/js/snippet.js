var Vue = require('vue');
var _ = require('lodash');
var github = require('octonode');
var CodeMirror = require('codemirror');

require('codemirror/addon/mode/loadmode')
require('codemirror/mode/meta')
require('codemirror/mode/htmlmixed/htmlmixed');
require('codemirror/mode/javascript/javascript');
require('codemirror/mode/jade/jade');
require('codemirror/mode/css/css');
require('codemirror/mode/sass/sass');
require('codemirror/mode/php/php');

//Vue.config.debug = true;

var snippetFile = Vue.extend({
  template: '#file',

  data: function(){
    return {
      mode: null
    }
  },
  props: ['file', 'index', 'key'],
  ready(){
    this.mode = this.findMode(this.file.filename);

    this.cm = CodeMirror.fromTextArea(this.$els.ed, {
      lineNumbers: true,
      tabSize: 2,
      mode: this.mode,
      theme: "material"
    });

    this.cm.on('change', function(cm) {
      this.$set('file.content', cm.getValue());
      // Add { silent: true }  as 3rd arg?
    }.bind(this));

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
        mode = spec = filename;
      }

      return mode;
    }
  }
});

var app = new Vue({
  el: '#gist',

  data: {
    files: null,
    description: ''
  },

  props: ['gistId', 'token'],

  ready() {
    var client = github.client(this.token);
    var ghgist = client.gist();
    ghgist.get(this.gistId, function(err, data, headers){
      this.$set('files', data.files);
      console.log(_.values(data.files));
      this.description = data.description;
    }.bind(this));
  },

  components: {
    'sn-file': snippetFile
  },

  methods: {
    addFile: function(){
      var file = {
        filename: '',
        content: '',
        raw_url: null
      }
      //this.$nextTick(function () {
        Vue.set(this.files, 'newfile', file);
      //});
    }
  }
});
