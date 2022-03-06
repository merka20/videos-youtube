(function() {
  var v = document.getElementsByClassName("youtube-player");
  for (var n = 0; n < v.length; n++) {
      var p = document.createElement("div");
      p.innerHTML = labnolThumb(v[n].dataset.id);
      p.onclick = labnolIframe;
      v[n].appendChild(p);
  }
})();

function labnolThumb(id) {
  return '<img class="imagen-previa" src="//i.ytimg.com/vi/' + id + '/hqdefault.jpg"><div class="youtube-play play"></div>';
}

function labnolIframe() {
  var iframe = document.createElement("iframe");
  iframe.setAttribute("src", "//www.youtube.com/embed/" + this.parentNode.dataset.id + "?autoplay=1&rel=0&autohide=2&border=0&wmode=opaque&fs=1&modestbranding=1&enablejsapi=1&controls=2&showinfo=0");
  iframe.setAttribute("frameborder", "0");
  iframe.setAttribute("id", "youtube-iframe");
  this.parentNode.replaceChild(iframe, this);
}