*Everything can be encoded or decoded*
Introduction
==
This small lib's purpose is to allow encoding and decoding of network packets.
It is made possible thanks to the basic implementation of https://github.com/zobo/php-pcap

To start off, this lib was made to decode dumps, so maybe not all the encoding functions are added for now!

Now let's take a look:

There is the LibPcap\Reader For reading a pcap file, and a LibPcap\Writer (which is the same as the reader, but or writing data).
The reader may read from a single file (Maybe more in the future)

The reader has the open method which will open a p/cap file, and parse it.

The reader then creates a LibPcap\File\Pcap, which allows interaction with the file.

The file is automatically parsed and generates a LibPcap\Packet\PacketBuffer, which is basicly an iterable object (you can use it in foreach's)


Packet structure
==
Every packet contained in the buffer has the following structure:

```
{
public function getHead();
public function getIpFrame();
public function getEthernetFrame();
public function getProtocol();
}
```

These are the basic functions, if no protocol has been determined, or maybe is not impelmented yet, the function `` getProtocol() `` whill return null.

A protocol is determined while the file is parsed, every protocol implemented is tried.

A protocol look smore or less like :

```
{
public function getName();
public function getSourcePort();
public function getDestinationPort();
}
```

Every field in a protocol is "dynamic", which means that while parsing any field can be added to the object, so to determine what protocol is a certain packett, you will need to call the ``getName()`` method.

List of implemented Protocols and names associated to them
==

| Protocol            | Name            |
| :-----------------: | :-------------: |
|  Dhcp               | dhcp            |
|  Http               | http            |
|  Tcp                | tcp             |
|  Udp                | udp             |
