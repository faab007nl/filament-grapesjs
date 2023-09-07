import grapesjs from "grapesjs";
import Swal from "sweetalert2";
import Toastify from 'toastify-js';

import blocksBasicPlugin from 'grapesjs-blocks-basic';
import countdownPlugin from 'grapesjs-component-countdown';
import exportPlugin from 'grapesjs-plugin-export';
import tabsPlugin from 'grapesjs-tabs';
import customCodePlugin from 'grapesjs-custom-code';
import touchPlugin from 'grapesjs-touch';
import tooltipPlugin from 'grapesjs-tooltip';
import typedPlugin from 'grapesjs-typed';
import presetWebpagePlugin from 'grapesjs-preset-webpage';

import "grapesjs/dist/css/grapes.min.css";
import "toastify-js/src/toastify.css";

document.addEventListener("alpine:init", function() {
    Alpine.data('grapesjs',
        ({state, statePath, readOnly, optionsEncoded}) => ({
            editor: null,
            state: state,
            open: false,
            editorHasChanges: false,

            openEditor() {
                this.open = true;
            },

            init() {
                const options = JSON.parse(new Buffer(optionsEncoded, 'base64').toString('ascii'));

                this.$watch('open', () => {
                    console.log('open changed')
                    console.log(this.open)
                });

                if (options === undefined) {
                    console.log('GrapesJs init failed: options undefined');
                    return;
                }

                console.log('GrapesJs init');
                console.log(options);

                this.editor =  grapesjs.init({
                    container: '#gjs',
                    height: '1024px',
                    width: '100%',
                    storageManager: {
                        type: 'remote',
                        autosave: options.autosave,
                        stepsBeforeSave: options.stepsBeforeSave,
                        recovery: options.recovery,
                        storeHtml: options.storeHtml,
                        storeStyles: options.storeStyles,
                        storeCss: options.storeCss,
                        options: {
                            remote: {
                                urlStore: options.urlStore,
                                urlLoad: options.urlLoad,
                                onLoad: function(res) {
                                    console.log('onLoad', res);
                                },
                                onStore: function(res) {
                                    console.log('onStore', res);
                                },
                            },
                        },
                    },
                    blockManager: {
                        blocks: [], // TODO:
                    },
                    plugins: [
                        blocksBasicPlugin,
                        countdownPlugin,
                        exportPlugin,
                        tabsPlugin,
                        customCodePlugin,
                        touchPlugin,
                        tooltipPlugin,
                        typedPlugin,
                        presetWebpagePlugin,
                    ],
                    pluginsOpts: {
                        [blocksBasicPlugin]: { flexGrid: true },
                        [countdownPlugin]: {
                            countdownBlock: {
                                category: 'Extra',
                            },
                            dateInputType: 'datetime-local',
                        },
                        [tooltipPlugin]: {
                            blockTooltip: {
                                category: 'Extra',
                            }
                        },
                        [tabsPlugin]: {
                            tabsBlock: {
                                category: 'Extra'
                            }
                        },
                        [typedPlugin]: {
                            block: {
                                category: 'Extra',
                                content: {
                                    type: 'typed',
                                    'type-speed': 40,
                                    strings: [
                                        'Text row one',
                                        'Text row two',
                                        'Text row three',
                                    ],
                                }
                            }
                        },
                        [presetWebpagePlugin]: {
                            modalImportTitle: 'Import Template',
                            modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
                            modalImportContent: function(editor) {
                                return editor.getHtml() + '<style>'+editor.getCss()+'</style>'
                            },
                        },
                    },
                });

                this.editor.on('update', function(e) {
                    this.editorHasChanges = true;
                });

                if (options.deviceManagerBtnEnabled) {
                    // Change the devices dropdown to 3 buttons
                    this.editor.getConfig().showDevices = 0;
                    this.editor.Panels.addPanel({
                        id: 'devices', buttons: [
                            { id: "set-device-desktop", command: function (e) { return e.setDevice("Desktop") }, className: "fa fa-desktop", active: 1 },
                            { id: "set-device-tablet", command: function (e) { return e.setDevice("Tablet") }, className: "fa fa-tablet" },
                            { id: "set-device-mobile", command: function (e) { return e.setDevice("Mobile portrait") }, className: "fa fa-mobile" }
                        ]
                    });
                }else{
                    this.editor.getConfig().showDevices = 0;
                }

                if(!options.viewComponentsBtnEnabled){
                    this.editor.Panels.removeButton('options', 'sw-visibility');
                }
                if(!options.previewBtnEnabled){
                    this.editor.Panels.removeButton('options', 'preview');
                }
                if(!options.viewCodeBtnEnabled){
                    this.editor.Panels.removeButton('options', 'export-template');
                }
                if(!options.fullscreenBtnEnabled){
                    this.editor.Panels.removeButton('options', 'fullscreen');
                }

                if(options.undoBtnEnabled){
                    this.editor.Panels.addButton('options', {
                        id: 'undo',
                        className: 'fa fa-undo',
                        command: function () {
                            this.editor.UndoManager.undo();
                        }
                    });
                }
                if(options.redoBtnEnabled){
                    this.editor.Panels.addButton('options', {
                        id: 'redo',
                        className: 'fa fa-repeat',
                        command: function () {
                            this.editor.UndoManager.redo();
                        }
                    });
                }
                if(options.importBtnEnabled){
                    this.editor.Panels.addButton('options', {
                        id: 'import',
                        className: 'fa fa-download',
                        command: function () {
                            this.editor.runCommand('gjs-open-import-webpage');
                        }
                    });
                }
                if(options.clearCanvasBtnEnabled){
                    this.editor.Panels.addButton('options', {
                        id: 'clear',
                        className: 'fa fa-trash',
                        command: function () {
                            Swal.fire({
                                title: 'Are you sure?',
                                showDenyButton: false,
                                showCancelButton: true,
                                confirmButtonText: 'Yes',
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    this.editor.runCommand('core:canvas-clear');
                                    Toastify({
                                        text: "Canvas cleared!",
                                        className: "toastify-success",
                                    }).showToast();
                                }
                            });
                        }
                    });
                }

                this.editor.Panels.addButton('options', {
                    id: 'save',
                    className: 'fa fa-save',
                    command: function () {
                        this.editor.store(this.editor.getProjectData()).then(r => {
                            Toastify({
                                text: "Saved!",
                                className: "toastify-success",
                            }).showToast();
                        });
                    }
                });
                this.editor.Panels.addButton('options', {
                    id: 'exit',
                    className: 'fa fa-times',
                    command: function () {
                        if (this.editorHasChanges) {
                            Swal.fire({
                                title: 'Do you want to save the changes?',
                                showDenyButton: true,
                                showCancelButton: true,
                                confirmButtonText: 'Save',
                                denyButtonText: `Don't save`,
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    this.editor.store(this.editor.getProjectData()).then(r => {
                                        Toastify({
                                            text: "Saved!",
                                            className: "toastify-success",
                                        }).showToast();
                                    });
                                    this.open = false;
                                } else if (result.isDenied) {
                                    this.open = false;
                                }
                            });
                        }else{
                            this.open = false;
                        }
                    }
                });


            }
        })
    );

});
