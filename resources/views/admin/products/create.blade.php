<!-- resources/views/admin/products/create.blade.php -->
<div class="form-group">
    <label>Variations</label>
    <div id="variations-container">
        <div class="variation-group mb-3">
            <div class="row">
                <div class="col-md-4">
                    <select name="variation_names[]" class="form-control">
                        <option value="size">Size</option>
                        <option value="color">Color</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" name="variation_values[]" class="form-control" placeholder="Comma-separated values (e.g., S,M,L)">
                </div>
            </div>
        </div>
    </div>
    <button type="button" id="add-variation" class="btn btn-sm btn-secondary">Add Variation</button>
</div>

<div id="variants-container" class="mb-3">
    <!-- Will be populated by JavaScript -->
</div>

@push('scripts')
    <script>
        document.getElementById('add-variation').addEventListener('click', function() {
            const container = document.getElementById('variations-container');
            const newGroup = document.querySelector('.variation-group').cloneNode(true);
            container.appendChild(newGroup);
        });

        // Generate variant combinations when variations change
        document.getElementById('variations-container').addEventListener('change', function() {
            // This would be more complex in a real implementation
            // You'd need to generate all possible combinations of variations
            console.log('Generate variants based on selected options');
        });
    </script>
@endpush
