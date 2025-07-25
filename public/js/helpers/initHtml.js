(function () {
  const tags = document.querySelectorAll("*");
  tags.forEach((tag) => {
    tag.setValue = (value, event = "change") => {
      tag.value = value;
      // IE9+ and other modern browsers
      if ("createEvent" in document) {
        const e = document.createEvent("HTMLEvents");
        e.initEvent(event, false, true);
        tag.dispatchEvent(e);
      } else {
        // IE8
        const e = document.createEventObject();
        e.eventType = event;
        tag.fireEvent("on" + e.eventType, e);
      }
    };
  });
})();
