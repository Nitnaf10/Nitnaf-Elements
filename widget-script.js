const container = document.getElementById('widgetContainer');
const styleSheet = document.createElement("style");
styleSheet.type = "text/css";

const generateParamsHTML = (params) => {
  return (params || []).map(param => {
    const className = param
      .replace(/[^a-zA-Z0-9 ]/g, '') // Remove special characters
      .split(' ') // Split by spaces
      .map(word => word.charAt(0).toUpperCase() + word.slice(1)) // Capitalize first letter
      .join(''); // Join back into a single string
    return `<p class="${className}">${param}</p>`; // Create a paragraph with the class name
  }).join(''); // Join all paragraphs into a single string
};

const generateLanguagesHTML = (languages) => {
  return (languages || []).map(language => {
    const langClass = CodeLanguages[0][language]; // Get the Devicon class from CodeLanguages
    return `<i class="${langClass}"></i>`; // Create an icon element for the language
  }).join(''); // Join all icons into a single string
};

// Function to check for SASS files
const containsSass = (widget) => {
  return widget.files && (widget.files.includes('.scss') || widget.files.includes('.sass'));
};

widgets.forEach(widget => {
  const div = document.createElement('div');
  div.className = 'widget';

  const paramsHTML = generateParamsHTML(widget["params-text"]); // Generate HTML for parameters
  const languagesHTML = generateLanguagesHTML(widget["languages"]); // Generate HTML for languages

  let cssDownloadButton = '';
  if (containsSass(widget)) {
    cssDownloadButton = `<a class="download dCSS" href="widgets/${widget.url}/${widget.name} Css.zip" download>Download the project's CSS</a>`;
  }

  div.innerHTML = `
    <div>
      <h2>${widget.name}</h2>
      <p class="short">${widget.short}</p>
      <div class="flex">${paramsHTML}</div> <!-- Display parameters -->
      <div class="flex">${languagesHTML}</div> <!-- Display languages -->
      <div class="flex">
        <a class="edit" href="widgets/${widget.url}/set.html" target="_blank">Edit widget</a>
        <a class="download dHTML" href="widgets/${widget.url}/${widget.name} Html.zip" download>Download the project in HTML</a>
        <a class="download dPHP" href="widgets/${widget.url}/${widget.name} Php.zip" download>Download the project in PHP</a>
        ${cssDownloadButton} 
      </div>
    </div>
    <iframe style="border:none;" src="widgets/${widget.url}/index.html?${widget.params}"></iframe>
  `;

  container.appendChild(div); // Append the widget to the container
});

// Generate styles for parameters
elements.forEach((className, index) => {
  const hue = index * 40;
  styleSheet.innerHTML += `
    .flex > .${className} {
      background-color: hsl(${hue}, 43.2%, 85.5%);
    }
  `;
});

document.head.appendChild(styleSheet); // Append the style sheet to the document head
