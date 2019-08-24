# 升级gcc

### 安装gcc4.9.0

```shell
wget ftp://ftp.gnu.org/gnu/gcc/gcc-4.9.0/gcc-4.9.0.tar.gz
tar xvf gcc-4.9.0.tar.gz
cd gcc-4.9.0
./contrib/download_prerequisites
./configure --enable-checking=release --enable-languages=c,c++ --disable-multilib
make -j2
make install
```

#### 注意

如果遇到执行 `./contrib/download_prerequisites` 很慢或者下载不了，可以进入到 `gcc.4.9.0` 目录直接执行下面命令来下载。

下载不了最好使用迅雷下载，有些忘了环境下载不了这几个文件，采用迅雷可以下载。

```shell
wget ftp://gcc.gnu.org/pub/gcc/infrastructure/cloog-0.18.1.tar.gz
tar xjf cloog-0.18.1.tar.gz

wget ftp://gcc.gnu.org/pub/gcc/infrastructure/isl-0.12.2.tar.bz2
tar xjf cloog-0.18.1.tar.gz

wget ftp://gcc.gnu.org/pub/gcc/infrastructure/mpc-0.8.1.tar.gz
tar xjf cloog-0.18.1.tar.gz

wget ftp://gcc.gnu.org/pub/gcc/infrastructure/gmp-4.3.2.tar.bz2
tar xjf gmp-4.3.2.tar.bz2

wget ftp://gcc.gnu.org/pub/gcc/infrastructure/mpfr-2.4.2.tar.bz2
tar xjf mpfr-2.4.2.tar.bz2

```

更新升级后的gcc还需要修改连接。不然gcc --version还是以前的版本信息。

```shell
mv /usr/bin/gcc /usr/bin/gcc-old
ln -s /usr/local/bin/gcc /usr/bin/gcc
```