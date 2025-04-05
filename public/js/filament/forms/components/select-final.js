{
    // Add "Select All" button to the DOM
    const selectAllButton = document.createElement('button');
    selectAllButton.className = 'select-all-button';
    selectAllButton.textContent = 'Select All';
    this.container.appendChild(selectAllButton);

    // Add event listener for "Select All" button
    selectAllButton.addEventListener('click', () => {
        this.selectAllChoices();
    });

    // Implement selectAllChoices method
    selectAllChoices() {
        const availableChoices = this._store.choices.filter(choice => !choice.disabled && !choice.placeholder);
        availableChoices.forEach(choice => {
            if (!this._store.activeItems.some(item => item.value === choice.value)) {
                this._addItem({ value: choice.value, label: choice.label, choiceId: choice.id });
            }
        });
        this._triggerChange(availableChoices.map(choice => choice.value));
        this._updateSelectAllButtonState();
    }

    // Update select all button state
    _updateSelectAllButtonState() {
        const allSelected = this._store.choices.every(choice =>
            choice.disabled || choice.placeholder || this._store.activeItems.some(item => item.value === choice.value)
        );
        this.selectAllButton.disabled = allSelected;
    }

    // Modify existing methods to update button state
    _addItem(item) {
        // Existing add item logic...
        this._updateSelectAllButtonState();
    }

    _removeItem(item) {
        // Existing remove item logic...
        this._updateSelectAllButtonState();
    }

    // Add button state update to other relevant methods
    // (e.g., when choices are filtered or when the component is initialized)
}
