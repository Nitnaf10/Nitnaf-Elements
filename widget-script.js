const container = document.getElementById('widgetContainer');
const styleSheet = document.createElement("style");
styleSheet.type = "text/css";

const generateParamsHTML = (params) => {
  return (params || []).map(param => {
    const className = param
      .replace(/[^a-zA-Z0-9 ]/g, '')
      .split(' ')
      .map(word => word.charAt(0).toUpperCase() + word.slice(1))
      .join('');
    return `<p class="${className}">${param}</p>`;
  }).join('');
};

const generateLanguagesHTML = (languages) => {
  return (languages || []).map(language => {
    const className = language
      .replace(/[^a-zA-Z0-9 ]/g, '')
      .split(' ')
      .map(word => word.charAt(0).toUpperCase() + word.slice(1))
      .join('');
    return `<p class="${className}"></p>`;
  }).join('');
};

widgets.forEach(widget => {
  const div = document.createElement('div');
  div.className = 'widget';

  const paramsHTML = generateParamsHTML(widget["params-text"]);
  const languagesHTML = generateLanguagesHTML(widget["languages"]);

  div.innerHTML = `
    <div>
      <h2>${widget.name}</h2>
      <p class="short">${widget.short}</p>
      <div class="flex">${paramsHTML}</div>
      <div class="flex">${languagesHTML}</div>
      <div class="flex">
        <a class="edit" href="widgets/${widget.url}/set.html" target="_blank">Edit widget</a>
        <a class="download dHTML" href="widgets/${widget.url}/${widget.name} Html.zip" download>Download the project in HTML</a>
        <a class="download dPHP" href="widgets/${widget.url}/${widget.name} Php.zip" download>Download the project in PHP</a>
      </div>
    </div>
    <iframe style="border:none;" src="widgets/${widget.url}/index.html?${widget.params}"></iframe>
  `;

  container.appendChild(div);
});

elements.forEach((className, index) => {
  const hue = index * 40;
  styleSheet.innerHTML += `
    .flex>.${className} {
      background-color: hsl(${hue}, 43.2%, 85.5%);
    }
    .flex>.${className}:before {
      content: url('images/${className}.svg');
    }
  `;
});

CodeLanguages.forEach(className => {
  styleSheet.innerHTML += `
    .flex>.${className} {
      content: url('images/${className}.svg');
    }
  `;
});

document.head.appendChild(styleSheet);
