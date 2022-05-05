# Netcode document

This document will outline the general gist of the network architecture we'll use for Damas RPG.

We'll describe:

- The overall networking architecture
- Connecting two different game clients across the public internet
- The chosen protocol
- The chosen serialization method
- The messages sent between nodes
- The chosen networking libraries

## Architecture

Damas RPG netcode will use a P2P-based approach with input transmission and periodic game state validation.

From now, we'll refer to "session" to refer to a game in progress, "game client" as an instance of the game that is running on a given player's machine, "authoritative node" as the game client who has control over the game state of the session, and "client node" to refer to the node of the session that is *not* the authoritative node.

When creating a new online game, the game client that chooses this option is the authoritative node for the session. This means that this game client will own, for all purposes, the up-to-date and correct game state. All other client nodes will follow this node.

In order for connection to be established, the authoritative node needs to know its own public IP address. The same is true for the client node. This connectivity will be discussed separately.

After connection is established between the two game clients, an initial handshake happens to determine which game client will start playing. For this purpose, each game client will generate an UUID for the session. This information will be transmitted in the handshake, and game clients will save this information.
After acknowledgement about which game client goes first, the game is started on both game clients.

Then, on every turn, the move currently selected by a given game client will be broadcasted to the other connected game client. An acknowledgement is expected to happen for every sent input.

Periodically, a game state validation will occur: the client node will serialize and send their game state for audit by the authoritative node. If the game states are the same, then the authoritative node will acknowledge and nothing else will be done. If they differ, the authoritative node will then serialize and send their game state to the client node. Upon receiving this new state, the client node will re-hydrate their own internal game state, and now both game clients should be in sync.

Note that sending the entire game state is not necessary. Game clients can maintain a hashed version of the game state and send this hash. Given that the game state is serializable, they will have identical hashes if they do not differ. Only on desynchronization of this game state should we serialize and send the whole game state object from the authoritative node to the client node.


## Connecting two different game clients across the public internet

To be defined.

## The chosen protocol

Game clients shall use UDP as the transmission protocol. How clients will discover which public IP to speak with is still to be defined, although the general idea is the usage of public IPs and a common port allocated per game client. Google offers a free STUN server that we can speak to to find out public IPs.

## The chosen serialization method

Game clients shall use Msgpack as the serialization method. Msgpack is a binary serialization format, which should make payloads sent through the wire between game clients as small as possible.

## Messages

Here's a list of possible messages to make the above architecture work. All messages are shown here as JSON for convenience, but in reality they will be binary marshalled to Msgpack messages.

- Create a game: `{"type": "CreateGame", "auth_id": "<uuid>"}`
  - Response: `{"ack": "CreateGame"}`
- Move a piece: `{"type": "MovePiece", "from": {"x": 0, "y": 0}, "to": {"x": 1, "y": 0}}`
- More messages to be defined...

## Chosen networking library

We'll leverage ENet as the networking library. ENet is widely used, and it's a solid choice for a C-based program.

