<div>
    <div class="card">
        <!-- Mengubah background header menjadi abu dan teks putih -->
        <div class="card-header text-white" style="background-color: #808080;">
            Borrow Books
            <!-- Search input dengan background putih tulang -->
            <input type="text" wire:model="search" class="form-control mt-2" placeholder="Search Member..."
                style="background-color: #f5f5dc;">
        </div>
        <!-- Mengubah background body menjadi putih tulang -->
        <div class="card-body" style="background-color: #f5f5dc;">
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <!-- Table dengan background putih tulang -->
                <table class="table" style="background-color: #f5f5dc;">
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
                                    <!-- Tombol Edit dengan warna biru -->
                                    <button wire:click="edit({{ $data->id }})" data-toggle="modal"
                                        data-target="#editModal" class="btn btn-sm btn-primary">Edit</button>
                                    <!-- Tombol Delete tetap berwarna merah -->
                                    <button wire:click="confirm({{ $data->id }})" data-toggle="modal"
                                        data-target="#deleteModal" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $pinjam->links() }}
            <!-- Tombol Create dengan warna hijau -->
            <button class="btn btn-success mt-3" data-toggle="modal" data-target="#createModal">Create</button>
        </div>
    </div>

    <!-- Create Modal -->
    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #808080;">Create Borrow</div>
                <div class="modal-body">
                    <!-- Form input -->
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <select wire:model="buku" class="form-control" style="background-color: #f5f5dc;">
                            <option value="">Select Book</option>
                            @foreach ($book as $b)
                                <option value="{{ $b->id }}">{{ $b->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Peminjam</label>
                        <select wire:model="user" class="form-control" style="background-color: #f5f5dc;">
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
                <div class="modal-header text-white" style="background-color: #808080;">Edit Borrow</div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <select wire:model="buku" class="form-control" style="background-color: #f5f5dc;">
                            @foreach ($book as $b)
                                <option value="{{ $b->id }}">{{ $b->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Peminjam</label>
                        <select wire:model="user" class="form-control" style="background-color: #f5f5dc;">
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
                <div class="modal-header text-white" style="background-color: #808080;">Confirm Delete</div>
                <div class="modal-body">Are you sure you want to delete this record?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click="delete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
