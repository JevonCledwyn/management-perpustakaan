<div>
    <div class="card">
        <!-- Mengubah background header menjadi abu dan teks putih -->
        <div class="card-header text-white" style="background-color: #808080;">
            Manage Pengembalian
        </div>
        <!-- Mengubah background body menjadi putih tulang -->
        <div class="card-body" style="background-color: #f5f5dc;">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Search input dengan background putih tulang -->
            <input type="text" wire:model.live="search" class="form-control w-50 mb-3" placeholder="Search Member..."
                style="background-color: #f5f5dc;">
            <div class="table-responsive">
                <!-- Table dengan background putih tulang -->
                <table class="table" style="background-color: #f5f5dc;">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Peminjam</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Tanggal Kembali</th>
                            <th scope="col">Denda</th>
                            <th scope="col">Process</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengembalians as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->pinjam->user->nama }}</td>
                                <td>{{ $data->pinjam->buku->judul }}</td>
                                <td>{{ $data->pinjam->tgl_pinjam }}</td>
                                <td>{{ $data->tgl_kembali }}</td>
                                <td>{{ $data->denda }}</td>
                                <td>
                                    <!-- Tombol Update dengan warna biru -->
                                    <a href="#" wire:click="edit({{ $data->id }})"
                                        class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#editPage">Update</a>
                                    <!-- Tombol Delete tetap berwarna merah -->
                                    <a href="#" wire:click="confirm({{ $data->id }})"
                                        class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#deletePage">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pengembalians->links() }}
            </div>
            <!-- Tombol Create dengan warna hijau -->
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#createPage">Create</a>
        </div>
    </div>

    <!-- Create Pengembalian (Modal) -->
    <div wire:ignore.self class="modal fade" id="createPage" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Pengembalian</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Peminjaman -->
                        <div class="form-group">
                            <label for="pinjam_id">Peminjaman</label>
                            <select wire:model="pinjam_id" class="form-control">
                                <option value="">Select Peminjaman</option>
                                @foreach ($peminjaman as $item)
                                    <option value="{{ $item->id }}">{{ $item->user->nama }} -
                                        {{ $item->buku->judul }}</option>
                                @endforeach
                            </select>
                            @error('pinjam_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Tanggal Kembali -->
                        <div class="form-group">
                            <label for="tgl_kembali">Tanggal Kembali</label>
                            <input type="date" wire:model="tgl_kembali" class="form-control">
                            @error('tgl_kembali')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Denda -->
                        <div class="form-group">
                            <label for="denda">Denda</label>
                            <input type="number" wire:model="denda" class="form-control">
                            @error('denda')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click="create" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Pengembalian (Modal) -->
    <div wire:ignore.self class="modal fade" id="editPage" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengembalian</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Peminjaman -->
                        <div class="form-group">
                            <label for="pinjam_id">Peminjaman</label>
                            <select wire:model="pinjam_id" class="form-control">
                                <option value="">Select Peminjaman</option>
                                @foreach ($peminjaman as $item)
                                    <option value="{{ $item->id }}">{{ $item->user->nama }} -
                                        {{ $item->buku->judul }}</option>
                                @endforeach
                            </select>
                            @error('pinjam_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Tanggal Kembali -->
                        <div class="form-group">
                            <label for="tgl_kembali">Tanggal Kembali</label>
                            <input type="date" wire:model="tgl_kembali" class="form-control">
                            @error('tgl_kembali')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Denda -->
                        <div class="form-group">
                            <label for="denda">Denda</label>
                            <input type="number" wire:model="denda" class="form-control">
                            @error('denda')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click="update" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Pengembalian (Modal) -->
    <div wire:ignore.self class="modal fade" id="deletePage" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Pengembalian</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Confirm to Delete Pengembalian?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click="delete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
