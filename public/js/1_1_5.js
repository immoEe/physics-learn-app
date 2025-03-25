document.addEventListener('DOMContentLoaded', () => {
    let draggedItem = null;
    let sourceZone = null;

    document.querySelectorAll('.drag-item').forEach(item => {
        item.addEventListener('dragstart', (e) => {
            draggedItem = item.cloneNode(true); 
            sourceZone = null; 
            e.dataTransfer.effectAllowed = 'copyMove';
        });

        item.addEventListener('dragend', () => {
            draggedItem = null;
            sourceZone = null;
        });
    });

    document.querySelectorAll('.drop-zone').forEach(zone => {
        zone.addEventListener('dragover', (e) => {
            e.preventDefault();
            zone.classList.add('hovered');
            e.dataTransfer.dropEffect = 'move';
        });

        zone.addEventListener('dragleave', () => {
            zone.classList.remove('hovered');
        });

        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.classList.remove('hovered');

            if (draggedItem) {
                const existingItem = zone.querySelector('.drag-item');
                
                if (existingItem) {
                    if (sourceZone) {
                        sourceZone.innerHTML = '';
                        sourceZone.appendChild(existingItem);
                    }
                }

                zone.innerHTML = '';
                const newItem = draggedItem.cloneNode(true);
                newItem.draggable = true;
                newItem.addEventListener('dragstart', handleDragStart);
                zone.appendChild(newItem);

                updateHiddenInput();
            }
        });
    });

    function handleDragStart(e) {
        draggedItem = e.target;
        sourceZone = draggedItem.closest('.drop-zone');
        e.dataTransfer.effectAllowed = 'move';
        draggedItem.classList.add('dragging');
    }

    function updateHiddenInput() {
        const answer = {};
        document.querySelectorAll('.drop-zone').forEach(zone => {
            const item = zone.querySelector('.drag-item');
            answer[zone.dataset.target] = item ? item.dataset.value : '';
        });
        document.getElementById('hidden-answer').value = JSON.stringify(answer);
    }
});