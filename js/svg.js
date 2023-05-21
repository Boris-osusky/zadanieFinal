function convertTableToSVG() {
    const tableElement = document.getElementById('studentTable');
    const tableHTML = tableElement.outerHTML;

    const svgContent = `
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
            <foreignObject width="100%" height="100%">
                <div xmlns="http://www.w3.org/1999/xhtml">
                    ${tableHTML}
                </div>
            </foreignObject>
        </svg>
        `;

    const blob = new Blob([svgContent], { type: 'image/svg+xml' });
    const url = URL.createObjectURL(blob);

    const linkElement = document.createElement('a');
    linkElement.href = url;
    linkElement.download = 'table.svg';

    document.body.appendChild(linkElement);
    linkElement.click();
    document.body.removeChild(linkElement);

    URL.revokeObjectURL(url);
}
document.addEventListener('DOMContentLoaded', function () {
    const exportButton = document.getElementById('exportButton');
    exportButton.addEventListener('click', convertTableToSVG);
});
