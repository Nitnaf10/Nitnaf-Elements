// --- Polices système ---
const systemFonts = [
  "Arial", "Verdana", "Tahoma", "Trebuchet MS", "Times New Roman", "Georgia", "Garamond",
  "Courier New", "Lucida Console", "Lucida Sans Unicode", "Palatino Linotype", "Segoe UI", "Impact"
];

// --- API Google Fonts --- (facultatif en front - attention à exposer une clé publique)
const apiKey = "AIzaSyCeuNt8nTwEs1_-TNA6AV0HEt2esWDVnVI";
let fonts = [...systemFonts];

fetch(`https://www.googleapis.com/webfonts/v1/webfonts?key=${apiKey}`)
  .then(response => response.json())
  .then(data => {
    if (data.items) {
      fonts = [...fonts, ...data.items.map(font => font.family)];
      populateDatalist('fonts', fonts);
    }
  })
  .catch(() => {
    populateDatalist('fonts', fonts); // fallback only system fonts
  });

// --- Couleurs CSS standard ---
const cssColors = [
  "aliceblue", "antiquewhite", "aqua", "aquamarine", "azure", "beige", "bisque", "black", "blanchedalmond", "blue",
  "blueviolet", "brown", "burlywood", "cadetblue", "chartreuse", "chocolate", "coral", "cornflowerblue", "cornsilk",
  "crimson", "cyan", "darkblue", "darkcyan", "darkgoldenrod", "darkgray", "darkgreen", "darkgrey", "darkkhaki",
  "darkmagenta", "darkolivegreen", "darkorange", "darkorchid", "darkred", "darksalmon", "darkseagreen",
  "darkslateblue", "darkslategray", "darkslategrey", "darkturquoise", "darkviolet", "deeppink", "deepskyblue",
  "dimgray", "dimgrey", "dodgerblue", "firebrick", "floralwhite", "forestgreen", "fuchsia", "gainsboro", "ghostwhite",
  "gold", "goldenrod", "gray", "green", "greenyellow", "grey", "honeydew", "hotpink", "indianred", "indigo", "ivory",
  "khaki", "lavender", "lavenderblush", "lawngreen", "lemonchiffon", "lightblue", "lightcoral", "lightcyan",
  "lightgoldenrodyellow", "lightgray", "lightgreen", "lightgrey", "lightpink", "lightsalmon", "lightseagreen",
  "lightskyblue", "lightslategray", "lightslategrey", "lightsteelblue", "lightyellow", "lime", "limegreen", "linen",
  "magenta", "maroon", "mediumaquamarine", "mediumblue", "mediumorchid", "mediumpurple", "mediumseagreen",
  "mediumslateblue", "mediumspringgreen", "mediumturquoise", "mediumvioletred", "midnightblue", "mintcream",
  "mistyrose", "moccasin", "navajowhite", "navy", "oldlace", "olive", "olivedrab", "orange", "orangered", "orchid",
  "palegoldenrod", "palegreen", "paleturquoise", "palevioletred", "papayawhip", "peachpuff", "peru", "pink", "plum",
  "powderblue", "purple", "rebeccapurple", "red", "rosybrown", "royalblue", "saddlebrown", "salmon", "sandybrown",
  "seagreen", "seashell", "sienna", "silver", "skyblue", "slateblue", "slategray", "slategrey", "snow", "springgreen",
  "steelblue", "tan", "teal", "thistle", "tomato", "turquoise", "violet", "wheat", "white", "whitesmoke", "yellow",
  "yellowgreen", "transparent"
];

// --- Unités CSS ---
const cssUnits = ['px','em','rem','%','vh','vw','pt','cm','mm','in','ex','cap','ch','ic'];

// --- Styles de bordure ---
const borderStyles = ['none','solid','dashed','dotted','double','groove','ridge','inset','outset','hidden'];

