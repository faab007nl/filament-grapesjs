export default function filamentGrapesJsComponent({
      state,
      statePath,
      readOnly,
      options
  }) {
    return {
        state,
        statePath,
        readOnly,
        options,

        init: function () {
            console.log('filamentGrapesJsComponent init');
            console.log(this.state);
        },
    }
}
