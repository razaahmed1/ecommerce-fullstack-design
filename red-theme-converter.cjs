const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        let dirPath = path.join(dir, f);
        let isDirectory = fs.statSync(dirPath).isDirectory();
        isDirectory ? walkDir(dirPath, callback) : callback(path.join(dir, f));
    });
}

function convertToRed(content) {
    // Tailwind classes
    content = content.replace(/yellow-400/g, 'red-500');
    content = content.replace(/yellow-500/g, '[#d32f2f]');
    content = content.replace(/yellow-600/g, 'red-700');
    content = content.replace(/yellow-700/g, 'red-800');
    content = content.replace(/yellow-800/g, 'red-900');
    content = content.replace(/yellow-900/g, 'red-950');
    
    // Hex and RGB gold replacements
    content = content.replace(/rgba\(212,175,55/g, 'rgba(211,47,47'); 
    content = content.replace(/rgba\(212, 175, 55/g, 'rgba(211, 47, 47');

    // Rounded styling replacements (make things more aggressive)
    content = content.replace(/rounded-\[40px\]/g, 'rounded-lg');
    content = content.replace(/rounded-3xl/g, 'rounded-lg');
    content = content.replace(/rounded-2xl/g, 'rounded');

    return content;
}

let viewsDir = path.join(__dirname, 'resources', 'views');

walkDir(viewsDir, function(filePath) {
    if (filePath.endsWith('.blade.php')) {
        let original = fs.readFileSync(filePath, 'utf8');
        let converted = convertToRed(original);
        if (original !== converted) {
            fs.writeFileSync(filePath, converted);
            console.log('Converted:', filePath);
        }
    }
});
