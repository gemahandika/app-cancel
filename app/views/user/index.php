   <main>
       <div class="container-fluid px-4">
           <h4 class="mt-4" style="border-bottom: solid 1px black;">User Aplikasi</h4>
           <?php Flasher::flash();  ?>
           <div class="row">
               <div class="col-lg-6">
                   <?php Flasher::loginFlash(); ?>
               </div>
           </div>
           <div class="card mb-4 mt-4">
               <div class="container mt-2">
                   <button
                       class="btn btn-primary btn-tambahUser"
                       data-bs-toggle="modal"
                       data-bs-target="#modalTambahUser"
                       data-id="<?= $open['id_resi']; ?>"
                       data-resi="<?= $open['no_resi']; ?>"
                       data-keterangan="<?= $open['keterangan']; ?>">
                       <i class="fa fa-plus"></i> Tambah User
                   </button>
               </div>
               <div class="card-header mt-4">
                   <i class="fas fa-table me-1"></i>
                   Data User Aplikasi
               </div>
               <div class="card-body">
                   <table id="example" class="display" style="width:100%">
                       <thead>
                           <tr class="bg-primary text-white">
                               <th class="small text-center">NO</th>
                               <th class="small text-center">USERNAME</th>
                               <th class="small text-center">NAMA AGEN</th>
                               <th class="small text-center">CUST ID</th>
                               <th class="small text-center">ROLE</th>
                               <th class="small text-center">STATUS</th>
                               <th class="small text-center">ACTION</th>

                           </tr>
                       </thead>
                       <tbody>
                           <?php
                            $no = 1;
                            foreach ($data['user'] as $user) :
                            ?>
                               <tr>
                                   <td class="small text-center"><?= $no++ ?></td>
                                   <td class="small text-center"><?= $user['username']; ?></td>
                                   <td class="small text-center"><?= $user['name']; ?></td>
                                   <td class="small text-center"><?= $user['cust_id']; ?></td>
                                   <td class="small text-center"><?= $user['role']; ?></td>
                                   <td class="small text-center"><?= $user['status']; ?></td>
                                   <td class="text-center">
                                       <button
                                           class="btn btn-warning btn-sm btn-editUser"
                                           data-bs-toggle="modal"
                                           data-bs-target="#modalEdit"
                                           data-id="<?= $user['id']; ?>"
                                           data-user="<?= $user['username']; ?>"
                                           data-password="<?= $user['password']; ?>"
                                           data-name="<?= $user['name']; ?>"
                                           data-role="<?= $user['role']; ?>"
                                           data-custid="<?= $user['cust_id']; ?>"
                                           data-status="<?= $user['status']; ?>">
                                           <i class="fa fa-edit"></i> EDIT
                                       </button>
                                   </td>
                               </tr>
                           <?php endforeach; ?>
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </main>

   <!-- Modal Tambah -->
   <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <form action="<?= BASEURL; ?>/user/tambahUser" method="POST">
                   <div class="modal-header bg-primary text-white">
                       <h5 class="modal-title " id="modalEditLabel">Tambah Data User</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                   </div>
                   <div class="modal-body">
                       <div class="mb-3">
                           <label for="username" class="form-label">Username</label>
                           <input type="text" class="form-control" name="username" id="username" required>
                       </div>
                       <div class="mb-3">
                           <label for="password" class="form-label">Password</label>
                           <input type="text" class="form-control" name="password" id="password" required>
                       </div>
                       <div class="mb-3">
                           <label for="name" class="form-label">Nama Agen / KP</label>
                           <input type="text" class="form-control" name="name" id="name" required>
                       </div>
                       <div class="mb-3">
                           <label for="cust_id" class="form-label">Cust ID</label>
                           <input type="text" class="form-control" name="cust_id" id="cust_id" required>
                       </div>
                       <div class="mb-3">
                           <label for="role" class="form-label">Role</label>
                           <select type="text" class="form-control" name="role" id="role" required>
                               <option value="agen">AGEN</option>
                               <option value="user">KP</option>
                               <option value="admin">ADMIN</option>
                           </select>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                       <button type="submit" class="btn btn-primary">Tambah User</button>
                   </div>
               </form>
           </div>
       </div>
   </div>

   <!-- Modal Edit -->
   <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <form action="<?= BASEURL; ?>/user/editUser" method="POST">
                   <div class="modal-header bg-primary text-white">
                       <h5 class="modal-title " id="modalEditLabel">Edit Data User</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                   </div>
                   <div class="modal-body">
                       <input type="hidden" name="edit-id" id="edit-id">
                       <div class="mb-3">
                           <label for="edit-username" class="form-label">Username</label>
                           <input type="text" class="form-control" name="edit-username" id="edit-username" required>
                       </div>
                       <div class="mb-3">
                           <label for="edit-name" class="form-label">Nama</label>
                           <input type="text" class="form-control" name="edit-name" id="edit-name" required>
                       </div>
                       <div class="mb-3">
                           <label for="edit-custid" class="form-label">Cust ID</label>
                           <input type="text" class="form-control" name="edit-custid" id="edit-custid" required>
                       </div>
                       <div class="mb-3">
                           <label for="edit-role" class="form-label">Role</label>
                           <select type="text" class="form-control" name="edit-role" id="edit-role" required>
                               <option value="agen">AGEN</option>
                               <option value="user">USER</option>
                               <?php if (isset($data['userRole']) && in_array($data['userRole'], ['superadmin'])) : ?>
                                   <option value="admin">ADMIN</option>
                               <?php endif; ?>
                           </select>
                       </div>
                       <div class="mb-3">
                           <label for="edit-status" class="form-label">Status</label>
                           <select type="text" class="form-control" name="edit-status" id="edit-status" required>
                               <option value="aktif">AKTIF</option>
                               <option value="nonaktif">NONAKTIF</option>
                           </select>
                       </div>
                       <!-- Tambahkan input lainnya sesuai kebutuhan -->
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                       <button type="submit" class="btn btn-primary">Update</button>
                   </div>
               </form>
           </div>
       </div>
   </div>