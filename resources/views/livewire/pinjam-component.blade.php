<div>
    <div class="card">
        <div class="card-header">
            Borrow Books
            <input type="text" wire:model="search" class="form-control" placeholder="Search Member...">
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pinjam as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->buku->judul }}</td>
                            <td>{{ $data->user->nama }}</td>
                            <td>{{ $data->tgl_pinjam }}</td>
                            <td>{{ $data->tgl_kembali }}</td>
                            <td>{{ $data->status }}</td>
                            <td>
                                <button wire:click="edit({{ $data->id }})" data-toggle="modal" data-target="#editModal"
                                    class="btn btn-sm btn-info">Edit</button>
                                <button wire:click="confirm({{ $data->id }})" data-toggle="modal"
                                    data-target="#deleteModal" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pinjam->links() }}
        </div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Create</button>
    </div>

    <!-- Create Modal -->
    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">Create Borrow</div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <select wire:model="buku" class="form-control">
                            <option value="">Select Book</option>
                            @foreach ($book as $b)
                                <option value="{{ $b->id }}">{{ $b->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Peminjam</label>
                        <select wire:model="user" class="form-control">
                            <option value="">Select Member</option>
                            @foreach ($member as $m)
                                <option value="{{ $m->id }}">{{ $m->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click="create" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">Edit Borrow</div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <select wire:model="buku" class="form-control">
                            @foreach ($book as $b)
                                <option value="{{ $b->id }}">{{ $b->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Peminjam</label>
                        <select wire:model="user" class="form-control">
                            @foreach ($member as $m)
                                <option value="{{ $m->id }}">{{ $m->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click="update" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">Confirm Delete</div>
                <div class="modal-body">Are you sure you want to delete this record?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click="delete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
