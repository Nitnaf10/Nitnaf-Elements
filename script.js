const container = document.getElementById('widgetContainer');

widgets.slice(0, 6).forEach(widget => {
  const div = document.createElement('div');
  div.className = 'widget';
  div.innerHTML = `
    <h2>${widget.name}</h2>
    <iframe style="border:none;" src="widgets/${widget.url}/index.html?${widget.params}"></iframe>
  `;

  container.appendChild(div);
});
