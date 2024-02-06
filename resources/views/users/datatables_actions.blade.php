<div class="d-flex justify-content-start align-items-center">

    {{-- Show --}}
    <x-forms.link-primary :link="route('users.show', $row->id)" class="mr-2 btn-xs">
        <i class="fas fa-eye"></i>
    </x-form.link-primary>

    {{-- Edit --}}
    <x-forms.link-secondary :link="route('users.edit', $row->id)" class="mr-2 btn-xs">
        <i class="fas fa-edit"></i>
    </x-form.link-secondary>

    <x-forms.link-danger :link="route('users.destroy', $row->id)" dataBsToggle="modal"
        dataBsModalTarget="#deleteModal{{ $row->id }}" class="btn-xs">
        <i class="fas fa-trash-alt"></i>
    </x-form.link-danger>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal{{ $row->id }}" tabindex="-1" role="dialog"
        aria-labelledby="deleteModal{{ $row->id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('users.destroy', $row->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal{{ $row->id }}Label">Are you sure you want to delete
                            this user?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger btn-sm">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
