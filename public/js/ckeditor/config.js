/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here.
    // For complete reference see:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for a single toolbar row.
    config.toolbarGroups = [
        { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
        { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
        { name: 'forms' },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
        { name: 'links' },
        { name: 'insert' },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'tools' },
        { name: 'others' },
        { name: 'about' }
    ];

    // The default plugins included in the basic setup define some buttons that
    // are not needed in a basic editor. They are removed here.
    config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript';

    // Dialog windows are also simplified.
    config.removeDialogTabs = 'link:advanced';

    config.filebrowserBrowseUrl = '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=files';
  config.filebrowserImageBrowseUrl =  '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=images';
  config.filebrowserUploadUrl = '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=files';
  config.filebrowserImageUploadUrl = '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=images';

  config.inlinesave = {
  postUrl: '/admin/story/update',
  postData: {test: true},
  onSave: function(editor) { console.log('clicked save', editor); return true; },
  onSuccess: function(editor, data) { console.log('save successful', editor, data); },
  onFailure: function(editor, status, request) { console.log('save failed', editor, status, request); },
  useJSON: false,
  useColorIcon: false
};
};
